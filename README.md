# Vorbereitung 🛠️
- docker installieren 🐳
- git installieren 🐙
- Repository mit SSH klonen 🔑

# Installation 💻
- `cd HydroFlux`
- `docker compose up -d`
- Wenn alles gestartet ist, muss telegraf eingerichtet werden. Dazu influx db unter: `http://<PI_IP>:8086` aufrufen 🌐
- GetStarted
- Nutzernamen, Passwort, Organisation und Bucketname eintragen:
  - Organisation: `pns` 🏢
  - Bucketname: `pns` 🪣
  - Werden abweichende Werte genutzt, müssen diese in der Influx config sowie in der telegraf config angepasst werden 🔧
- Danach den generierten Token speichern, dieser ist für Admin-Zwecke ggf. später wichtig 🔑
  - Dies ist nicht der Token, der später für Grafana und Telegraf benötigt wird. Diesen NUR für Admin-Zwecke nutzen ⚠️
- Quick Start
- Links auf den Pfeil nach oben (LoadData) ➡️
- API Tokens
- Generate API Token -> All Access API Token 🔑
- Beschreibung nach Belieben, z.B.: Grafana und Telegraf
- Token kopieren und sicher speichern (am besten in einem Passwortmanager) 🛡️

# Telegraf einrichten 🔧
- In Konsole wechseln und die telegraf.conf öffnen:
  - `nano telegraf/telegraf.conf`
  - Hier dann `"<INFLUX_TOKEN>"` durch den Token ersetzen 🔁
  - Wichtig: Die Anführungszeichen müssen bestehen bleiben 📝
  - Speichern und verlassen 💾
- Mit `docker restart telegraf` den Container neu starten 🔄

# Grafana einrichten 📊
- Unter `http://<PI_IP>:3030` Grafana öffnen 🌐
- Burgermenü -> Connections -> Data Source -> Add Data Source ➕
- InfluxDB
- Query language: Flux
- URL: http://influxdb:8086
- Basic Auth: Check ✅
- Basic Auth Details: Nutzername und Passwort von Influx eingeben 🔐
- InfluxDB Details:
  - Organisation: pns 🏢
  - Token: Den gespeicherten Token (der gleiche wie für telegraf) 🔑
  - Default Bucket: pns 🪣
- Save and test 💾✅

# Testdaten erzeugen 🧪
- Unter `http://<PI_IP>:1880` NodeRed öffnen 🌐
- Burgermenü -> Import -> Lokal -> dataFaker.json 📁
- Auf Übernahme(deploy) drücken ▶️
- Nun sollen Werte gesendet werden 📈

# Daten Script einrichten 📝
- Wieder zu Influx wechseln: `http://<PI_IP>:8086` 🌐
- Links auf den Graph (DataExplorer) gehen 📊
- Query einrichten 🔍:
  - From: hier pns auswählen 🏢
  - 1. Filter: hier nach host im Filter suchen (std: _measurement)
  - Entsprechenden Host wählen 🖥️
  - Im 2. Filter topic wählen (std: _field)
  - Einen oder mehrere Topics wählen 📚
  - (optional) Unter Window Period last wählen
  - Submit
  - Script Editor aufrufen 📝
  - Gesamtes Script kopieren 📋
  - Zu Grafana wechseln 📊
  - Burgermenü -> Dashboards -> Create Dashboard (oder ein vorhandenes wählen) ➕
  - Neuen Graphen auswählen (beim ersten Mal sollte auch die DataSource ausgewählt werden. Hier die Influx nutzen)
  - Unter Query in den Queryeditor (wenn leer, dann ist das unter A) den kopierten Query aus der InfluxDB einfügen 📊

## Neue Topics einrichten 🆕
- In Konsole wechseln und die telegraf.conf öffnen:
  - `nano telegraf/telegraf.conf` (erst in Projektverzeichnis wechseln)
  - Hier dann unten bei topics die neuen Topics eintragen 📝
  - Speichern und verlassen 💾
- Mit `docker restart telegraf` den Container neu start




