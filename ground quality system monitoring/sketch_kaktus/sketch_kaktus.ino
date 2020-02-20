#include "Arduino.h"
#include "DHT.h"
#include <SPI.h>
#include <Ethernet.h>
#define analogInPin A3  //sambungkan kabel hitam (output) ke pin A0
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; //Setting MAC Address dari Router

//variable pH
int sensorpHValue = 0;        //ADC value from sensor
float outputpHValue = 0.0;        //pH value after conversion

int rainPin = A1; //pin Soil Moisture A1
int greenLED = 6;
int redLED = 7;
// you can adjust the threshold value
int thresholdValue = 400;
float humidityData;
float temperatureData;
int sensorValue;

char server[] = "latihanarjun.dx.am";
EthernetClient client;


void setup(){
  
  Serial.begin(9600);
  dht.begin();
  pinMode(rainPin, INPUT);
  pinMode(greenLED, OUTPUT);
  pinMode(redLED, OUTPUT);
  digitalWrite(greenLED, LOW);
  digitalWrite(redLED, LOW);
    {Serial.println("Initialize Ethernet with DHCP:");
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
  delay(1000);
}
}
  
  void loop() {
   //Mathematical conversion from ADC to pH
  //rumus didapat berdasarkan datasheet 
  // read the input on analog pin 0:
  //read the analog in value sensorpH:
  sensorpHValue = analogRead(analogInPin);
  outputpHValue = (-0.0693*sensorpHValue)+7.3855;


  //Soil Moisture
  sensorValue = analogRead(rainPin); 
  //print the results to the serial monitor:

    //DHT
    humidityData = dht.readHumidity();
    temperatureData = dht.readTempC(); 

    //sensor Soil Moisture
//  Serial.print(sensorValue);
  if(sensorValue < thresholdValue){
    Serial.println(" - Doesn't need watering");
    digitalWrite(redLED, LOW);
    digitalWrite(greenLED, HIGH);
  }
  else {
    Serial.println(" - Time to water your plant");
    digitalWrite(redLED, HIGH);
    digitalWrite(greenLED, LOW);
  }

  Sending_To_phpmyadmindatabase(); 
  delay(30000); // interval
}


void Sending_To_phpmyadmindatabase()   //CONNECTING WITH MYSQL
 {
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    Serial.print("GET /simon-server/tanah/create.php?humidity=");
    client.print("GET /simon-server/tanah/create.php?humidity=");     //YOUR URL

    //DHT11
    Serial.println(humidityData);
    client.print(humidityData);
    client.print("&temperature=");
    Serial.println("&temperature=");
    client.print(temperatureData);
    Serial.println(temperatureData);

    //Soil Moisture
    client.print("&kelembaban_tanah=");
    Serial.println("&kelembaban_tanah=");
    client.print(sensorValue);
    Serial.println(sensorValue);


    //ph tanah
    client.print("&ph=");
    Serial.println("&ph=");
    client.print(outputpHValue);
    Serial.println(outputpHValue);

//
//  Serial.print("sensor ADC= ");
//  Serial.print(sensorpHValue);
//  Serial.print("  output Ph= ");
//  Serial.println(outputpHValue);


    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: latihanarjun.dx.am");
    client.println("User-Agent: Arduino/1.0");
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
 }
