///*
//
//  All the resources for this project:
//  https://randomnerdtutorials.com/
//
//*/
//
//int soilPin = A0; //PinSoil Moisture
//int greenLED = 6;
//int redLED = 7;
//// you can adjust the threshold value
//int thresholdValue = 800;
//int sensorSoilValue = analogRead(soilPin);
//
//void setup() {
//  pinMode(soilPin, INPUT);
//  pinMode(greenLED, OUTPUT);
//  pinMode(redLED, OUTPUT);
//  digitalWrite(greenLED, LOW);
//  digitalWrite(redLED, LOW);
//  Serial.begin(9600);
//}
//
//void loop() {
//  // read the input on analog pin A1:
//  Serial.print(sensorSoilValue);
//  if (sensorSoilValue < thresholdValue) {
//    Serial.println(" - Doesn't need watering");
//    digitalWrite(redLED, LOW);
//    digitalWrite(greenLED, HIGH);
//  }
//  else {
//    Serial.println(" - Time to water your plant");
//    digitalWrite(redLED, HIGH);
//    digitalWrite(greenLED, LOW);
//  }
//  delay(1000);
//}

#define analogInPin A0 //pin Sensor pH tanah
#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; //Setting MAC Address

const int sensorSoilPin = A1; // pin Sensor Soil Moisture
float kelembaban_tanah;
int nilaiADC = analogRead(sensorSoilPin);

char server[] = "latihanarjun.dx.am";
EthernetClient client; 

//variable
int sensorpHValue = 0;        //ADC value from sensor
float outputpHValue = 0.0;        //pH value after conversion

void setup() {
  Serial.begin(9600);
    {
      //pinMode(buzzer, OUTPUT);
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
      // data = ""; //test code baru
  delay(1000);
  }
}

void loop() {

  //read the analog in value:
  sensorpHValue = analogRead(analogInPin);

  //Mathematical conversion from ADC to pH
  //rumus didapat berdasarkan datasheet 
  outputpHValue = (-0.0693*sensorpHValue)+7.3855;

  //print the results to the serial monitor:
  Serial.print("sensor ADC= ");
  Serial.print(sensorpHValue);
  Serial.print("  output pH Tanah= ");
  Serial.println(outputpHValue);
  
  //SoilMoisture
  kelembaban_tanah = ( 100 - ( (nilaiADC/1023.00) * 100 ) );
  Serial.print("Kelembaban tanah = ");
  Serial.print(kelembaban_tanah);
  Serial.println("%");
  delay(1000);
}
