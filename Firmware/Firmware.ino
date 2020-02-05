
// Include Libraries
#include "Arduino.h"
#include "DHT.h"
#include "MQ135.h"
#include "MQ2.h"


// Pin Definitions
#define DHT_PIN_DATA	2
#define MQ135_5V_PIN_AOUT	A2
#define MQ2_5V_PIN_AOUT	A0
#define MQ9_5V_PIN_AOUT	A1


// Global variables and defines

// object initialization
DHT dht(DHT_PIN_DATA);
MQ135 mq(MQ135_5V_PIN_AOUT);
MQ2 mq2(MQ2_5V_PIN_AOUT);
MQ2 mq9(MQ2_5V_PIN_AOUT);

// define vars for testing menu
const int timeout = 100;       //define timeout of 10 sec
char menuOption = 0;
long time0;

// Setup the essentials for your circuit to work. It runs first every time your circuit is powered with electricity.
void setup() 
{
    // Setup Serial which is useful for debugging
    // Use the Serial Monitor to view printed messages
    Serial.begin(9600);
    while (!Serial) ; // wait for serial port to connect. Needed for native USB
    Serial.println("start");
    
    dht.begin();
//    menuOption = menu();
    
}

// Main logic of your circuit. It defines the interaction between the components you selected. After setup, it runs over and over again, in an eternal loop.
void loop() 
{
    
    // DHT22/11 Humidity and Temperature Sensor - Test Code
    // Reading humidity in %
    float dhtHumidity = dht.readHumidity();
    delay(10000);
    // Read temperature in Celsius, for Fahrenheit use .readTempF()
    float dhtTempC = dht.readTempC();
    delay(10000);
    Serial.print(F("Kelembaban Udara: ")); Serial.print(dhtHumidity); Serial.println(F(" [%]\t"));
    Serial.print(F("Temperatur Udara: ")); Serial.print(dhtTempC); Serial.println(F(" [C]"));


    // MQ-135 Hazardous Gas Sensor - Test Code
    // Reading Gas in %
    float mqPPM = mq.getPPM();
    delay(10000);
    float mqResistance = mq.getResistance();
    delay(10000);
    Serial.print(("Indeks Gas Beracun: ")); Serial.print(mqPPM); Serial.print((" [Ppm]\t"));
    Serial.print(("Resistansi: ")); Serial.print(mqResistance); Serial.println((" [R]"));


    // MQ-2 LPG Gas Sensor - Test Code
    // Reading Gas in %
    float mq2readLPG = mq2.readLPG();
    delay(1000);
    float mq2readSmoke = mq2.readSmoke();
    delay(10000);
    Serial.print(("LPG: ")); Serial.print(mq2readLPG); Serial.println((" [Ppm]\t"));
    Serial.print(("Asap: ")); Serial.print(mq2readSmoke); Serial.println((" [Ppm]"));


//     MQ-9 Carbon Monoxide, and Methane gas - Test Code
//     Reading Gas in %
    float mq9readCO = mq9.readCO();
    delay(10000);
//    float mq9readMethane = mq9.getMethane_ppm();
    Serial.print(("Karbon Monoksida: ")); Serial.print(mq9readCO); Serial.println((" [Ppm]\t"));
//    Serial.print(("Methane: ")); Serial.print(mq9readMethane); Serial.println((" [Ppm]"));
//    }
//    
    
}
