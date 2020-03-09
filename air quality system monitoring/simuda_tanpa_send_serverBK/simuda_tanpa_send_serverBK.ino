//Pemanggilan Library Arduino
#include <DHT.h>;
#include "Arduino.h"
#include <SPI.h>
#include <Ethernet.h>

//mendefinisikan MAC Address dari TP-LINK Router
byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; 


//mendefinisikan pin sensor pada port arduino
#define DHTPIN  7
#define DHTTYPE DHT22
#define pinSensor0 A0 // MQ-2
#define pinSensor1 A1 // MQ-9
#define pinSensor2 A2 // MQ-135
#define pinSensor3 A3 // MQ-136


//inisialisasi pin sensor sharp
int measurePin = A4;     
int ledPower = 2;

//inisialisasi pin sensor DHT22
DHT dht(DHTPIN, DHTTYPE);

//penentuan value set sensor SHARP     
int   samplingTime = 280;  
int   deltaTime    = 40;      
int   sleepTime    = 9680;    
float voMeasured   = 0;    
float calcVoltage  = 0;   
float dustDensity  = 0;   

//penentuan value set sensor DHT22               
int chk;
float humidityData;
float temperatureData;

//penentuan value set sensor mq-2, mq-9, mq-135, mq-136
long RLmq2 = 1000; // 1000 Ohm
long Romq2 = 830; // 830 ohm 
long RLmq9 = 1000;
long Romq9 = 830; 
long RLmq135 = 1000;
long Romq135 = 830;
long RLmq136 = 1000;
long Romq136 = 830;



//mq135
//int sensorvalue2 = analogRead(pinSensor2); // membaca nilai ADC dari sensor
//float VRLmq135 = sensorvalue2*5.00/1024;  // mengubah nilai ADC ( 0 - 1023 ) menjadi nilai voltase ( 0 - 5.00 volt )
//float Rsmq135 = ( 5.00 * RLmq135 / VRLmq135 ) - RLmq135;
//float ppmc = 100 * pow(Rsmq135 / Romq135,-1.53); // ppm = 100 * ((rs/ro)^-1.53);



float ppma;
float ppmb;
float ppmc;
float ppmd;

//inisialisasi alamat web server
char server[] = "latihanarjun.dx.am";
EthernetClient client; 



void setup()
{
 Serial.begin(9600);
 dht.begin();
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


void loop()
{  
Sending_To_phpmyadmindatabase();
delay(6000);
}

void Sending_To_phpmyadmindatabase()   //CONNECTING WITH MYSQL
 {
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    Serial.print("GET /simon-server/udara/create.php?humidity=");
    client.print("GET /simon-server/udara/create.php?humidity=");     //YOUR URL
      humidityData = dht.readHumidity();
      temperatureData = dht.readTemperature();
      //DHT22
        client.print(humidityData);  
        Serial.println(humidityData); 
        client.print("&temperature=");
        Serial.println("&temperature=");
        client.print(temperatureData);
        Serial.println(temperatureData);

        //MQ135
        int sensorvalue2 = analogRead(pinSensor2); // membaca nilai ADC dari sensor
        float VRLmq135 = sensorvalue2*5.00/1024;  // mengubah nilai ADC ( 0 - 1023 ) menjadi nilai voltase ( 0 - 5.00 volt )
        float Rsmq135 = ( 5.00 * RLmq135 / VRLmq135 ) - RLmq135;
        float ppmc = 100 * pow(Rsmq135 / Romq135,-1.53); // ppm = 100 * ((rs/ro)^-1.53); DATA YANG DIKIRIM KE SERVER
        
        client.print("&amonia=");
        Serial.println("&amonia=");
        client.print(ppmc);
        Serial.println(ppmc);
  

          //MQ-2
          int sensorvalue0 = analogRead(pinSensor0); // membaca nilai ADC dari sensor
          float VRLmq2 = sensorvalue0*5.00/1024;  // mengubah nilai ADC ( 0 - 1023 ) menjadi nilai voltase ( 0 - 5.00 volt )
          float Rsmq2 = ( 5.00 * RLmq2 / VRLmq2 ) - RLmq2;
          float ppma = 100 * pow(Rsmq2 / Romq2,-1.53); // ppm = 100 * ((rs/ro)^-1.53);
          client.print("&gas_dan_asap=");
          Serial.println("&gas_dan_asap=");
          client.print(ppma);
          Serial.println(ppma);




         //mq-9
        int sensorvalue1 = analogRead(pinSensor1); // membaca nilai ADC dari sensor
        float VRLmq9 = sensorvalue1*5.00/1024;  // mengubah nilai ADC ( 0 - 1023 ) menjadi nilai voltase ( 0 - 5.00 volt )
        float Rsmq9 = ( 5.00 * RLmq9 / VRLmq9 ) - RLmq9;
        float ppmb = 100 * pow(Rsmq9 / Romq9,-1.53); // ppm = 100 * ((rs/ro)^-1.53);
        client.print("&co=");
        Serial.println("&co=");
        client.print(ppmb);
        Serial.println(ppmb);



         //mq136
        int sensorvalue3 = analogRead(pinSensor3); // membaca nilai ADC dari sensor
        float VRLmq136 = sensorvalue3*5.00/1024;  // mengubah nilai ADC ( 0 - 1023 ) menjadi nilai voltase ( 0 - 5.00 volt )
        float Rsmq136 = ( 5.00 * RLmq136 / VRLmq136 ) - RLmq136;
        float ppmd = 100 * pow(Rsmq136 / Romq136,-1.53); // ppm = 100 * ((rs/ro)^-1.53);
      
        client.print("&hidrogen_sulfida=");
        Serial.println("&hidrogen_sulfida=");
        client.print(ppmd);
        Serial.println(ppmd);

           //Sharp
        digitalWrite(ledPower,LOW); // power on the LED
        delayMicroseconds(samplingTime);
        voMeasured = analogRead(measurePin); // read the dust value
        delayMicroseconds(deltaTime);
        digitalWrite(ledPower,HIGH); // turn the LED off
        delayMicroseconds(sleepTime);
        calcVoltage = voMeasured * (3.3 / 1024);
        dustDensity = 0.17 * calcVoltage - 0.1;

          client.print("&konsentrasi_debu=");
          Serial.println("&konsentrasi_debu=");
          client.print(dustDensity);
          Serial.println(dustDensity);

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
