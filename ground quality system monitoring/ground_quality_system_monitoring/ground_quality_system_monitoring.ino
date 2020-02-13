//Soil Moisture Relay Sensor

int Relay = 13;
int sensorSoil = A1;
int val;

void setup(){
  pinMode(13, OUTPUT); //set pin 13 as OUTPUT pin, to send signal to relay
  pinMode(A1, INPUT); //set Pin A0 as input pin soil moisture
}

void loop() {
  val = digitalRead(A1);
  if(val == LOW) {
    digitalWrite(13, LOW); // if soil moisture sensor provide LOW Value send LOW value to relay TANAH BASAH
    Serial.println(" - Doesn't need watering");
    
  }
  else {
    digitalWrite(13, HIGH); //if soil moisture sensor provides HIGH value send HIGH value to relay TANAH KERING
    Serial.println(" - Time to water your plant");
  }
  delay(1000);
}
