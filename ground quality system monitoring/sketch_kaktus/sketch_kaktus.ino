/*
 
 All the resources for this project:
 http://randomnerdtutorials.com/
 
*/
#define analogInPin A0  //sambungkan kabel hitam (output) ke pin A0


//variable pH
int sensorpHValue = 0;        //ADC value from sensor
float outputpHValue = 0.0;        //pH value after conversion

int rainPin = A1;
int greenLED = 6;
int redLED = 7;
// you can adjust the threshold value
int thresholdValue = 400;

void setup(){
  Serial.begin(9600);
  pinMode(rainPin, INPUT);
  pinMode(greenLED, OUTPUT);
  pinMode(redLED, OUTPUT);
  digitalWrite(greenLED, LOW);
  digitalWrite(redLED, LOW);
}
  
  void loop() {
    
  //read the analog in value sensorpH:
  sensorpHValue = analogRead(analogInPin);
  //Mathematical conversion from ADC to pH
  //rumus didapat berdasarkan datasheet 
  outputpHValue = (-0.0693*sensorpHValue)+7.3855;
  // read the input on analog pin 0:
  int sensorValue = analogRead(rainPin);
  //print the results to the serial monitor:
  
  Serial.print("sensor ADC= ");
  Serial.print(sensorpHValue);
  Serial.print("  output Ph= ");
  Serial.println(outputpHValue);

  //sensor Soil Moisture
  Serial.print(sensorValue);
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
  delay(1000);
}
