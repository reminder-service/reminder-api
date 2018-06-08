# reminder-api
Backend API of Reminder Service
## Requirements
- PHP (Tested with 5.6 and 7)
- MySQL compatible database
- Webserver that is able to accept `PATCH` requests
## Installation
- Execute install SQL-Script on database (.project/reminder.sql) 
- Configure database connection in settings file (lib/settings.php)
- Upload php scripts to webserver
## Endpoints
### Message

* **URL**

  `GET` /message/index.php
  
*  **URL Params**
 
   `identifier=[string]`

* **Success Response:**
  
  * **Code:** 200 <br />
    **Content:** `[{"id":"1","message":"Message content","timestamp":"2018-01-01 12:00:00"}]`

* **Notes:**

  Gets all messages or the one that are not yet read for given identifier.</br>
  When there is no identifier set gets all messages.
  
----

* **URL**

  `POST` /message/index.php
  
*  **Data Params**
 
   `message=[string]`

* **Success Response:**
  
  * **Code:** 201 <br />
    **Content:** Empty
    
* **Notes:**

  Posts a new message to the system.
    
### Identifier

* **URL**

  `GET` /identifier/index.php
  
*  **URL Params**
 
   `identifier=[string]`

* **Success Response:**
  
  * **Code:** 200 <br />
    **Content:** `[{"client_identifier":"home","message_level":"5"}]`

* **Notes:**

  When there is no identifier set gets all registered identifiers else it gets the given identifier.
  
----

* **URL**

  `POST` /identifier/index.php
  
*  **Data Params**
 
   `identifier=[string]`

* **Success Response:**
  
  * **Code:** 201 <br />
    **Content:** Empty
    
* **Notes:**

  Posts a new identifier to the system.
  
  
----

* **URL**

  `PATCH` /identifier/index.php
  
*  **URL Params**
 
   `identifier=[string]`

* **Success Response:**
  
  * **Code:** 201 <br />
    **Content:** Empty
    
* **Notes:**

  Sets the message level of given identifier to most current and marks all messages as read.
