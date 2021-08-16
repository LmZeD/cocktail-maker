#include <SoftwareSerial.h>
SoftwareSerial hc06(2,3);

String cmd ="";
bool bufferOpen = false;

void setup()
{
  Serial.begin(9600);

  digitalWrite(4,HIGH);
  digitalWrite(5,HIGH);
  digitalWrite(6,HIGH);
  digitalWrite(7,HIGH);
  digitalWrite(8,HIGH);
  digitalWrite(9,HIGH);
  digitalWrite(10,HIGH);
  digitalWrite(11,HIGH);

  pinMode(4, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(6, OUTPUT);
  pinMode(7, OUTPUT);
  pinMode(8, OUTPUT);
  pinMode(9, OUTPUT);
  pinMode(10, OUTPUT);
  pinMode(11, OUTPUT);

  hc06.begin(9600);
}

void loop()
{
  while(hc06.available() > 0){
    char letter = (char)hc06.read();

    if (letter == '|' && bufferOpen == false) {
      bufferOpen = true;
      continue;
    }
    if (letter == '|' && bufferOpen == true) {
      bufferOpen = false;
      continue;
    }
    if (bufferOpen == true) {
       cmd += letter;
    }
  }

  if(cmd != "" && bufferOpen == false){
    processCmd(cmd);
    cmd = "";
  }

}

// cmd is always pump_number:5_digits_amount - 1:02500
void processCmd(String cmd)
{
  String pumpCast = "";
  int amount = 0;
  int pumpId = 0;
  Serial.println("Cmd pre process: " + cmd);

  if ((char)cmd[1] == ':' && (
        (String)cmd[0] == "1" ||
        (String)cmd[0] == "2" ||
        (String)cmd[0] == "3" ||
        (String)cmd[0] == "4" ||
        (String)cmd[0] == "5" ||
        (String)cmd[0] == "6" ||
        (String)cmd[0] == "7" ||
        (String)cmd[0] == "8"
      )
  ) {
      Serial.println("Cmd: " + cmd);
      pumpCast = (String)cmd[0];
      String amountCast = (String)cmd[2] + (String)cmd[3] + (String)cmd[4] + (String)cmd[5] + (String)cmd[6];
      amount = amountCast.toInt();
      pumpId = pumpCast.toInt();

      digitalWrite(getPumpPin(pumpId), LOW);
      delay(amount);
      digitalWrite(getPumpPin(pumpId), HIGH);

      Serial.println("Processed cmd: " + cmd);
  }
}

int getPumpPin(int pumpId)
{
    return pumpId + 3;
}
