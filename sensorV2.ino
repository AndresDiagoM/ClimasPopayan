#include <WiFi.h>
#include "DHT.h"
#define DHTPIN 4     // El número que se le debe asignar a DHTPIN debe ser el número del pin GPIO de la tarjeta ESP32 que se utilice para conectar el sensor DHT22.
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321

DHT dht(DHTPIN, DHTTYPE);

const char* ssid     = "Tenda_E40BE0";      // SSID
const char* password = "F9rMyam5";      // Password

const char* host = "climaspopayan.online";  // Dirección IP local o remota, del Servidor Web   climalab3.000webhostapp.com     climaspopayan.online
//const char* host = "192.168.1.72";  // Dirección IP local o remota, del Servidor Web
const int   port = 80;            // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;        // Frecuencia del Watchdog
unsigned long previousMillis = millis(); 

String dato;
String cade;
String hum_max;
String temp_max;
String line;
float SW;
String SWS;
float t_max;
float h_max;
int sensorWater1=0; 

int gpio5_pin = 5; // El GPIO5 de la tarjeta ESP32, corresponde al pin D5 identificado físicamente en la tarjeta. Este pin será utilizado para una salida de un LED.
int gpio15_pin = 15; // Se debe tener en cuenta que el GPIO4 es el pin D4, ver imagen de GPIOs de la tarjeta ESP32. Este pin será utilizado para una salida de un LED para alertas.
int gpio2_pin = 2; // Se debe tener en cuenta que el GPIO2 es el pin D2, ver imagen de GPIOs de la tarjeta  ESP32. Este pin será utilizado para una salida de un LED para alertas.
int sensorWater = 34;// pin para el sensor de agua
int ID_TARJ=2; // Este dato identificará cual es la tarjeta que envía los datos, tener en cuenta que se tendrá más de una tarjeta. 
 
void setup() {
  pinMode(gpio5_pin, OUTPUT);
  pinMode(gpio2_pin, OUTPUT);
  pinMode(gpio15_pin, OUTPUT);
  pinMode(sensorWater, INPUT);
  Serial.begin(115200);
  Serial.print("Conectando a...");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  dht.begin();
 
  Serial.println("");
  Serial.println("WiFi conectado");  
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());
}
 
void loop() {
  unsigned long currentMillis = millis();

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  
  sensorWater1= analogRead(sensorWater);
  Serial.print(sensorWater1);
  Serial.print("******************************************");
  if(sensorWater1<=1000){
    SW=10;
    SWS = "SIN LLUVIA";
    }else if(sensorWater1>1000 and sensorWater1<=2500){
     SW=20;
     SWS = "LLOVISNANDO";
    }else if(sensorWater1>2500){
     SW=30;
     SWS = "LLOVIENDO";
    }

  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C ");
  Serial.print("lluvia: ");
  Serial.print(SWS);
  

  

  digitalWrite(gpio5_pin, LOW);
  digitalWrite(gpio15_pin, LOW);
  digitalWrite(gpio2_pin, LOW);

// Primero se consultan los datos maximos de temp y hum

  if ( currentMillis - previousMillis > watchdog ) {
    previousMillis = currentMillis;
    WiFiClient client;
  
    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      return;
    }
 
    String url = "/programas_php3/proceso_eventos/programa5.php";
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        Serial.println(">>> Superado tiempo de espera!");
        return;
      }
    }
    
    // Lee respuesta del servidor
    while(client.available()){
          line = client.readString();
          line.trim();
          Serial.print(line);
//          line = "2080";  
      }
      int longitud = line.length();
      int longitud_f = longitud;
      longitud = longitud - 4;
      
      dato = line.substring(longitud,longitud_f);
      cade = "Dato recibido es...";
      cade += dato; 
      Serial.print(cade);

      hum_max = dato.substring(2,4);
      temp_max = dato.substring(0,2);
       
      // Lo siguiente se utiliza para pasar la cadena de texto a un flotante, para poder comparar
      char cadena[temp_max.length()+1];
      temp_max.toCharArray(cadena, temp_max.length()+1);
      t_max = atof(cadena);
      
      // Lo siguiente se utiliza para pasar la cadena de texto a un flotante, para poder comparar
      char cadena2[hum_max.length()+1];
      hum_max.toCharArray(cadena2, hum_max.length()+1);
      h_max = atof(cadena2);

      cade = "Temp max es...";
      cade += t_max;
      Serial.print(cade);
      
      cade = "Humedad max es...";
      cade += h_max;
      Serial.print(cade);

      if (t > t_max)
        {
         Serial.print("ALERTA TEMPERATURA");
         digitalWrite(gpio15_pin, HIGH);
        }
      if (h > h_max)
        {
         Serial.print("ALERTA HUMEDAD");
         digitalWrite(gpio2_pin, HIGH);
        }
      delay(2000);
    }
  
// Ahora se guardan los valores medidos en la base de datos

   currentMillis = millis();
   if ( currentMillis - previousMillis > watchdog ) {
    previousMillis = currentMillis;
    WiFiClient client;
  
    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      return;
    }

    String url2 = "/programas_php3/proceso_eventos/programa1.php?humedad=";
    url2 += h;
    url2 += "&temperatura=";
    url2 += t;
    url2 += "&ID_TARJ=";
    url2 += ID_TARJ;
    url2 += "&estado_lluvia=";
    url2 += SWS;
    
    // Envío de la solicitud al Servidor
    client.print(String("POST ") + url2 + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
    unsigned long timeout2 = millis();
    while (client.available() == 0) {
      if (millis() - timeout2 > 5000) {
        Serial.println(">>> Superado tiempo de espera!");
        client.stop();
        return;
      }
    }
  
    // Lee respuesta del servidor
    while(client.available()){
      line = client.readStringUntil('\r');
      Serial.print(line);
    }
      digitalWrite(gpio5_pin, HIGH);
      Serial.print("Dato ENVIADO");
      delay(2000);
  }
  
}
