# GrazeTech Sabre API
## Overview
This is a modern PHP PSR-2 compliant fork of the official Sabre distribution. You may load it into your application by adding with composer.

The Sabre API Code Samples for PHP project’s purpose is to provide the reference code and enable quick and easy start to consuming Sabre Webservices. It focuses on business case usage, so it shows how to chain several REST calls into a workflow, where the subsequent call uses the previous one’s result. Its structure is designed to easily reuse parts of the classes, whole classes, modules or even whole project in client’s applications.
## Configuring the application
The configuration is located in *SabreRestConfig.ini* file. It keeps the properties which are needed to connect and authenticate to the Sabre’s REST webservices. They are being read by the *SabreConfig* class, which contains the *getRestProperty()* which reads the value of the property. For configuration for SOAP webservices look into the *SabreSoapConfig.ini* file, and you can retrieve them using the *getSoapProperty()* method.

Your credentials available in the Sabre Dev Studio are given in such a format: `V1:userId:group:domain`, so they should be put into separate properties in the *.ini* file. 

Although the credentials are not encrypted right now to lower the project entry time, it is strongly recommended to use the encryption in production systems and do not keep the credentials in plain text.

Please register at https://developer.sabre.com in order to obtain your own credentials.
