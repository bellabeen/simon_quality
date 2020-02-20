// Include Libraries
#include "Arduino.h"
#include "DHT.h"
#include "MQ135.h"
#include "MQ2.h"
#include <SPI.h>
#include <Ethernet.h>



byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; //Setting MAC Address


#define DHT_PIN_DATA  2
#define MQ135_5V_PIN_AOUT  A2
#define MQ2_5V_PIN_AOUT A0
#define MQ9_5V_PIN_AOUT  A1


// object initialization
DHT dht(DHT_PIN_DATA);
MQ135 mq(MQ135_5V_PIN_AOUT);
MQ2 mq2(MQ2_5V_PIN_AOUT);
MQ2 mq9(MQ9_5V_PIN_AOUT);


float humidityData;
float temperatureData;
float LPGData;
float smokeData;
float mqPPM;
float mqResistance;
float readCO;

float rs;
const float ro;
float lgppm;
int ppm;

//void speedBuzzer(int waktu);
//const int pinBuzzer = 9;
//int ulang = 0;
  
//float rs = r1 * ((1023.0 / sensorValue) - 1.0);
//const float ro = rs/r1;
//float lgppm = (log10(ro)* (-2.6)+ 2.7);
//int ppm = pow(10,lgppm);
  


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




char server[] = "latihanarjun.dx.am";
EthernetClient client; 
//IPAddress ip(192,168,0,177); 


/* Setup for Ethernet and RFID */

void setup() {
Serial.begin(9600);
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
//------------------------------------------------------------------------------


/* Infinite Loop */
void loop(){
//    for ( ulang = 0; ulang < 20; ulang++)
//      speedBuzzer(250);
//    
//    for ( ulang = 0; ulang < 20; ulang++)
//      speedBuzzer(500);
//    
//
//void speedBuzzer(int waktu)
//  digitalWrite(pinBuzzer, HIGH);
//  delay(waktu);
//  digitalWrite(pinBuzzer, LOW);
//  delay(waktu);

  //DHT
    humidityData = dht.readHumidity();
    temperatureData = dht.readTemperature(); 

  //Sensor MQ136
  
//    rs = r1 * ((1023.0 / sensorValue) - 1.0);
//    ro = rs/r1;
//    lgppm = (log10(ro)* (-2.6)+ 2.7);
//    ppm = pow(10,lgppm);
//  
//    Serial.print("resistansi sensor : ");
//    Serial.println(sensorValue,DEC);
//    Serial.print("nilai ppm :");
//    Serial.println (ppm, DEC);


   //MQ135
    mqPPM = mq.getPPM();
    mqResistance = mq.getResistance(); 


   //MQ2
   LPGData = mq2.readLPG();
   smokeData = mq2.readSmoke();
   
   //MQ9
    readCO = mq2.readCO();
   
    
  Sending_To_phpmyadmindatabase(); 
  delay(30000); // interval
}


  void Sending_To_phpmyadmindatabase()   //CONNECTING WITH MYSQL
 {
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    Serial.print("GET /testcode/sensor.php?humidity=");
    client.print("GET /testcode/sensor.php?humidity=");     //YOUR URL

    //DHT11
    Serial.println(humidityData);
    client.print(humidityData);
    client.print("&temperature=");
    Serial.println("&temperature=");
    client.print(temperatureData);
    Serial.println(temperatureData);

    //MQ135
    client.print("&nilai_amonia_sulfida_benzena=");
    Serial.println("&nilai_amonia_sulfida_benzena=");
    client.print(mqPPM);
    Serial.println(mqPPM);
    client.print("&resistansi_amonia_sulfida_benzena=");
    Serial.println("&resistansi_amonia_sulfida_benzena=");
    client.print(mqResistance);
    Serial.println(mqResistance);


    //MQ2
    client.print("&nilai_gas_lpg=");
    Serial.println("&nilai_gas_lpg=");
    client.print(LPGData);
    Serial.println(LPGData);
    client.print("&nilai_asap=");
    Serial.println("&nilai_asap=");
    client.print(smokeData);
    Serial.println(smokeData);


    //MQ9
    client.print("&nilai_karbonmonoksida=");
    Serial.println("&nilai_karbonmonoksida=");
    client.print(readCO);
    Serial.println(readCO);
//    client.print("&nilai_gas_metana=");
//    Serial.println("&nilai_gas_metana=");
//    client.print(MethanaData);
//    Serial.println(MethanaData);

    
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: latihanarjun.dx.am");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
 }
  
