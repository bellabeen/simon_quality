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

const int sensorSoilPin = A1; // pin Sensor Soil Moisture
float kelembaban_tanah;
int nilaiADC = analogRead(sensorSoilPin);

//variable
int sensorpHValue = 0;        //ADC value from sensor
float outputpHValue = 0.0;        //pH value after conversion

void setup() {
  Serial.begin(9600); 
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
