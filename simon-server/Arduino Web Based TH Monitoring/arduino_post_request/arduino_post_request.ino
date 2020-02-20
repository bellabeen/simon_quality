#include <dht.h>
#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x01 }; // RESERVED MAC ADDRESS
IPAddress ip(192, 168, 100, 125);
EthernetClient client;

dht DHT;
#define DHT11_PIN 5 // SENSOR PIN


long previousMillis = 0;
unsigned long currentMillis = 0;
long interval = 2500; // READING INTERVAL

float t = 0;	// TEMPERATURE VAR
float h = 0;	// HUMIDITY VAR
String data;

void setup() { 
	Serial.begin(9600);
  Serial.println("Passed Step to Start The Serial");
  
	if (Ethernet.begin(mac) == 0) {
		Serial.println("Failed to configure Ethernet using DHCP"); 
	  Ethernet.begin(mac,ip);
	}
Serial.print("Passed Step to Getting IP");

	delay(1000); // GIVE THE SENSOR SOME TIME TO START

	data = "";
}

void loop(){
  Serial.print("DHT11, \t");
  int chk = DHT.read11(DHT11_PIN);
  switch (chk)
  {
    case DHTLIB_OK:  
                Serial.print("OK,\t"); 
                break;
    case DHTLIB_ERROR_CHECKSUM: 
                Serial.print("Checksum error,\t"); 
                break;
    case DHTLIB_ERROR_TIMEOUT: 
                Serial.print("Time out error,\t"); 
                break;
    case DHTLIB_ERROR_CONNECT:
        Serial.print("Connect error,\t");
        break;
    case DHTLIB_ERROR_ACK_L:
        Serial.print("Ack Low error,\t");
        break;
    case DHTLIB_ERROR_ACK_H:
        Serial.print("Ack High error,\t");
        break;
    default: 
                Serial.print("Unknown error,\t"); 
                break;
  }
	currentMillis = millis();
	if(currentMillis - previousMillis > interval) { // READ ONLY ONCE PER INTERVAL
		previousMillis = currentMillis;
		h = DHT.humidity;
		t = DHT.temperature;
	}
  h = DHT.humidity;
    t = DHT.temperature;
	data = "temp1=" + String(t) + "&hum1=" + String(h);

	if (client.connect("xxxxxxxxxx.com",80)) { //Ganti dengan alamat website anda. Utk localhost, ganti dengan 127.0.0.1
		Serial.println("Sending to Server: ");
		client.println("POST /add.php HTTP/1.1"); 
    Serial.println("POST /add.php HTTP/1.1"); 
		client.println("Host: xxxxxxxxxxxxxxxxxxxxx.com"); // Ganti dengan alamat website anda. Utk localhost, ganti dengan 127.0.0.1
		client.println("User-Agent: Arduino/1.0");
		client.println("Content-Type: application/x-www-form-urlencoded"); 
		client.print("Content-Length: "); 
		client.println(data.length()); 
		client.println(); 
		client.println(data); 
    Serial.print(data);
	} 

	if (client.connected()) { 
		client.stop();	// DISCONNECT FROM THE SERVER
	}

	delay(600000); // WAIT FIVE MINUTES BEFORE SENDING AGAIN
}



