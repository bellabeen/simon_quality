#include <SPI.h>
#include <Ethernet.h>

// mac address
byte mac[] = { 0x98, 0xDA, 0xC4, 0x99, 0x7A, 0xE6 }; 

// settian API ThingSpeak
char thingSpeakAddress[] = "api.thingspeak.com";
String writeAPIKey = "1XSQL09OK6V8NQ5U";
const int updateThingSpeakInterval = 5 * 1000; //update data tiap 30 detik sekali     

long lastConnectionTime = 0; 
boolean lastConnected = false;
int failedCounter = 0;

EthernetClient client; //inisialisasi arduino sbg Ethernet client

void setup()
{
  Serial.begin(9600); //inisialiasi port serial utk debugging
  
  startEthernet();
}

void loop()
{
  // baca tegangan analog di pin A0
  String analogValue0 = String(analogRead(A0), DEC);
//  String analogValue1 = String(analogRead(A1), DEC);
  if (client.available())
  {
    char c = client.read();
    Serial.print(c);
  }

  // Disconnect dari ThingSpeak
  if (!client.connected() && lastConnected)
  {
    Serial.println("...disconnected");
    Serial.println();
    
    client.stop();
  }
  
  // Update data ke ThingSpeak
  if(!client.connected() && (millis() - lastConnectionTime > updateThingSpeakInterval))
  {
    updateThingSpeak("field1="+analogValue0);
//    updateThingSpeak("fieldl="+analogValue1);
  }
  
  // Check if Arduino Ethernet needs to be restarted
  if (failedCounter > 3 ) {
    startEthernet();
    }
  
  lastConnected = client.connected();
}

void updateThingSpeak(String tsData)
{
  if (client.connect(thingSpeakAddress, 80))
  {         
    client.print("POST /update HTTP/1.1\n");
    client.print("Host: api.thingspeak.com\n");
    client.print("Connection: close\n");
    client.print("X-THINGSPEAKAPIKEY: "+writeAPIKey+"\n");
    client.print("Content-Type: application/x-www-form-urlencoded\n");
    client.print("Content-Length: ");
    client.print(tsData.length());
    client.print("\n\n");

    client.print(tsData);
    
    lastConnectionTime = millis();
    
    if (client.connected())
    {
      Serial.println("Connecting to ThingSpeak...");
      Serial.println();
      
      failedCounter = 0;
    }
    else
    {
      failedCounter++;
  
      Serial.println("Connection to ThingSpeak failed ("+String(failedCounter, DEC)+")");   
      Serial.println();
    }
    
  }
  else
  {
    failedCounter++;
    
    Serial.println("Connection to ThingSpeak Failed ("+String(failedCounter, DEC)+")");   
    Serial.println();
    
    lastConnectionTime = millis(); 
  }
} 

void startEthernet()
{
  
  client.stop();

  Serial.println("Connecting Arduino to network...");
  Serial.println();  

  delay(1000);
  
  // Ckonek ke jaringan
  if (Ethernet.begin(mac) == 0)
  {
    Serial.println("DHCP Failed, reset Arduino to try again");
    Serial.println();
  }
  else
  {
    Serial.println("Arduino connected to network using DHCP");
    Serial.println();
  }
  
  delay(1000);
}
