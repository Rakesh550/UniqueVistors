# Unique Visitors Tracking App
 
## Intro
Assignment to set up CI/CD for Unique Visitors Tracking App
 
## Prerequisites
 
Install                          | Virtual Machine with Docker engine   
---------------------------------|------------
Terraform                        | for Infra Provisioning
 Azure Account                   | Service Priniciples - Subcription ID, Client ID, Client Secret , Tenant ID
Visual Studio (recommended)      | VS 2019+
 
 
## Getting Started

 
**Environment**  
1.  Provision the Infra ( linux VM ) in Azure either manually or using Terraform scripts added to the repo
2.  Install Docker Engine in VM
 
**Application** 
     # Clone source
   1. clone the private repo via ssh by adding deploy key to repo
   2. Update the secrets at for github actions (main.yml) - 
        ${{ secrets.HOST }}
        ${{ secrets.USERNAME }}
        ${{ secrets.PASSWORD }}
        
   3. Import the counter.sql dump file by loging to admirer(mysql remote client) at port 8080. ( refere the mysql credentials used in index.php)
   4. There you go!!   -   access the webpage at port 8000 - Test with multiple IPs
 
## CI/CD with Github-Actions
CI/CD process has been set up to this this Application & can refer the .github/workflows/main.yml

 
## Explainatory video link -  Kindly Refer below video link
    ```
   https://www.loom.com/share/471cbaea81cb4a7fb824236f20085cdc
   
    ```
    
To test the app use this public ip 51.120.245.172 in different devices.

Feel free to reach me for any questions -  Thanks for this exciting assignment.

