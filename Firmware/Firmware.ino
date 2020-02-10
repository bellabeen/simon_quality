
// Include Libraries
#include "Arduino.h"
#include "DHT.h"
#include "MQ135.h"
#include "MQ2.h"
#include <SPI.h>
#include <Ethernet.h>

// mac address
byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; 

// Pin Definitions
#define DHT_PIN_DATA	2
#define MQ135_5V_PIN_AOUT	A2
#define MQ2_5V_PIN_AOUT	A0
#define MQ9_5V_PIN_AOUT	A1

int t = 0;  // TEMPERATURE VAR
int h = 0;  // HUMIDITY VAR


int sensor = A3;
int sensorValue = 0;
const float r1 = 20000.0;
int measurePin = 6;
int ledPower = 12;
int samplingTime = 280;
int deltaTime = 40;
int sleepTime = 9680;
float voMeasured = 0;
float calcVoltage = 0;
float dustDensity = 0;
//long lastConnectionTime = 0; 
//boolean lastConnected = false;
//int failedCounter = 0;

long previousMillis = 0;
unsigned long currentMillis = 0;
long interval = 250000; // READING INTERVAL
String data;
char server[] = "latihanarjun.dx.am";


// Global variables and defines

// object initialization
DHT dht(DHT_PIN_DATA);
MQ135 mq(MQ135_5V_PIN_AOUT);
MQ2 mq2(MQ2_5V_PIN_AOUT);
MQ2 mq9(MQ2_5V_PIN_AOUT);

EthernetClient client; //inisialisasi arduino sbg Ethernet client


// Setup the essentials for your circuit to work. It runs first every time your circuit is powered with electricity.
void setup() 
{
    Serial.begin(9600);
  
        Serial.println("Initialize Ethernet with DHCP:");
      if (Ethernet.begin(mac) == 0) {
        Serial.println("Failed to configure Ethernet using DHCP");
        // Check for Ethernet hardware present
        if (Ethernet.hardwareStatus() == EthernetNoHardware) {
          Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
          while (true) {
            delay(1); // do nothistartng, no point running without Ethernet hardware
          }
        }
        if (Ethernet.linkStatus() == LinkOFF) {
          Serial.println("Ethernet cable is not connected.");
        }
        // try to congifure using IP address instead of DHCP:
        Ethernet.begin(mac);
      } else {
        Serial.print("DHCP assigned IP ");
        Serial.println(Ethernet.localIP());
      }
  
      // if you get a connection, report back via serial:
      if (client.connect(server, 80)) {
        Serial.print("connected to ");
        Serial.println(client.remoteIP());
      } else {
        // if you didn't get a connection to the server:
        Serial.println("connection failed to server");
      }
  
      Serial.println("still working here");
  
      dht.begin();
      delay(10000); // GIVE THE SENSOR SOME TIME TO START
    
    h = (int) dht.readHumidity();
    t = (int) dht.readTempC();
    
    data = "";
}

// Main logic of your circuit. It defines the interaction between the components you selected. After setup, it runs over and over again, in an eternal loop.
void loop() 
{
//
//    currentMillis = millis();
//  if(currentMillis - previousMillis > interval) { // READ ONLY ONCE PER INTERVAL
//    previousMillis = currentMillis;
    h = (int) dht.readHumidity();
    t = (int) dht.readTempC();
    
    data = "temp1=" + String(t) + "&hum1=" + String(h);
  if (client.connect(server,80)) { // REPLACE WITH YOUR SERVER ADDRESS
    Serial.println(data);
    client.println("GET /add.php HTTP/1.1"); 
    client.println("Host: www.latihanarjun.dx.am"); // SERVER ADDRESS HERE TOO
    client.println("Content-Type: application/x-www-form-urlencoded"); 
    client.print("Content-Length: "); 
    client.println(data.length()); 
    client.println(); 
    client.print(data);
//     Serial.println("Successfull");
  } 

    if (client.connected()) { 
    client.stop();  // DISCONNECT FROM THE SERVER
    Serial.println("Client Stopped");
  }

  delay(100000); // WAIT FIVE MINUTES BEFORE SENDING AGAIN
  

  
//    // DHT22/11 Humidity and Temperature Sensor - Test Code
//    // Reading humidity in %
//    float dhtHumidity = dht.readHumidity();
//    delay(1000);
//    // Read temperature in Celsius, for Fahrenheit use .readTempF()
//    float dhtTempC = dht.readTempC();
//    delay(1000);
//    Serial.print(F("Kelembaban Udara: ")); 
//    Serial.print(dhtHumidity); 
//    Serial.println(F(" [%]\t"));
//    Serial.print(F("Temperatur Udara: ")); 
//    Serial.print(dhtTempC); Serial.println(F(" [C]"));



//    //sensor mq136
    float rs = r1 * ((1023.0 / sensorValue) - 1.0);
    const float ro = rs/r1;
    float lgppm = (log10(ro)* (-2.6)+ 2.7);
    int ppm = pow(10,lgppm);
  
    Serial.print("resistansi sensor : ");
    Serial.println(sensorValue,DEC);
    Serial.print("nilai ppm :");
    Serial.println (ppm, DEC);
    delay(1000);
//
//
//    // MQ-135 Hazardous Gas Sensor - Test Code
//    // Reading Gas in %
//    float mqPPM = mq.getPPM();
//    delay(1000);
//    float mqResistance = mq.getResistance();
//    delay(1000);
//    Serial.print(("Indeks Gas Beracun: ")); Serial.print(mqPPM); Serial.print((" [Ppm]\t"));
//    Serial.print(("Resistansi: ")); Serial.print(mqResistance); Serial.println((" [R]"));
//
//
    // MQ-2 LPG Gas Sensor - Test Code
    // Reading Gas in %
    float mq2readLPG = mq2.readLPG();
    delay(1000);
    float mq2readSmoke = mq2.readSmoke();
    delay(1000);
    Serial.print(("LPG: ")); Serial.print(mq2readLPG); Serial.println((" [Ppm]\t"));
    Serial.print(("Asap: ")); Serial.print(mq2readSmoke); Serial.println((" [Ppm]"));
//
//
////     MQ-9 Carbon Monoxide, and Methane gas - Test Code
////     Reading Gas in %
//    float mq9readCO = mq9.readCO();
//    delay(1000);
////    float mq9readMethane = mq9.getMethane_ppm();
//    Serial.print(("Karbon Monoksida: ")); Serial.print(mq9readCO); Serial.println((" [Ppm]\t"));
////  Serial.print(("Methane: ")); Serial.print(mq9readMethane); Serial.println((" [Ppm]"));
////    }
////    
//    digitalWrite(ledPower,LOW); // power on the LED
//  delayMicroseconds(samplingTime);
// 
//  voMeasured = analogRead(measurePin); // read the dust value
// 
//  delayMicroseconds(deltaTime);
//  digitalWrite(ledPower,HIGH); // turn the LED off
//  delayMicroseconds(sleepTime);
// 
//  // 0 - 3.3V mapped to 0 - 1023 integer values
//  // recover voltage
//  calcVoltage = voMeasured * (3.3 / 1024);
// 
//  // linear eqaution taken from http://www.howmuchsnow.com/arduino/airquality/
//  // Chris Nafis (c) 2012
//  dustDensity = 0.17 * calcVoltage - 0.1;
// 
//  Serial.print("Raw Signal Value (0-1023): ");
//  Serial.print(voMeasured);
// 
//  Serial.print(" - Voltase: ");
//  Serial.print(calcVoltage);
// 
//  Serial.print(" - Konsentrasi Debu μMg/M3: ");
//  Serial.println(dustDensity);
 
//  delay(1000);
}
