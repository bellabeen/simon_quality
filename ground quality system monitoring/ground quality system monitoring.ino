#define analogInPin A0


//variable private
const int sensorPin = A1;
int sensorValue = 0;
float outputValue = 0.0;

void setup() {
  Serial.begin(9600); 
}

void loop() {
  float kelembaban_tanah;
  int nilaiADC = analogRead(sensorPin);
  kelembaban_tanah = ( 100 - ( (nilaiADC/1023.00) * 100 ) );

  
    //read the analog in value:
  sensorValue = analogRead(analogInPin);

  //Mathematical conversion from ADC to pH
  //rumus didapat berdasarkan datasheet 
  outputValue = (-0.0693*sensorValue)+7.3855;

  //print the results to the serial monitor:
  Serial.print("sensor ADC= ");
  Serial.print(sensorValue);
  Serial.print("  output Ph= ");
  Serial.print(outputValue);
  
  Serial.print("Kelembaban tanah = ");
  Serial.print(kelembaban_tanah);
  Serial.print("%\n\n");
  delay(1000);
}
