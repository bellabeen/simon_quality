#ifndef _____MQ9_____
#define _____MQ9_____

#include "mbed.h"

#define MQ9_STATUS_PASS 0
#define MQ9_STATUS_FAIL -1

/** Class for the MQ9 sensor.
 *  This library is a modified version of the MQ2 library for Arduino 
 * Example:
 * 
 */ 
class MQ9
{
public:
    /// Construct the sensor object and setup the sensor pins
    MQ9(PinName const &p);
    
    /// Update the gas concentrations from the sensor.
    int read();
    
    /** Get concentration of LPG
    *     Returns the concentration of LPG as a floating number.
    */
    float getLPG_ppm();
    
    /** Get concentration of CO,
    *    Returns the concentration of CO as a floating number.
    */
    float getCO_ppm();
    
    /** Get concentration of Methane
    *    Returns the concentration of Methane as a floating number.
    */
    float getMethane_ppm();

private:
    /// Concentration of LPG
    float _LPG_ppm;
    /// Concentration of CO
    float _CO_ppm;
    /// Concentration of Methane
    float _Methane_ppm;
    
    /// pin to read the sensor information
    AnalogIn _pin;
};

#endif
