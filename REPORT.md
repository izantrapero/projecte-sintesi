# REPORT – Projecte de Síntesi

## 1. Dades generals

Nom del projecte: projecte-sintesi

Integrants: Izan Trapero, David Sanchez, Iván Fernández

Tecnologia principal (Laravel / React / Fullstack): Laravel

Enllaç al repositori: https://github.com/izantrapero/projecte-sintesi

Data d’entrega:

## 2. Estat inicial del projecte

Descriviu la situació del projecte abans de començar el treball de desplegament.

Incloeu: 

- Estructura inicial del repositori
- Problemes detectats (si n’hi havia)
- Existència o no de .gitignore
- Existència o no de Docker
- Problemes de configuració o dependències
Reflexió breu:

Què faltava perquè aquest projecte es pogués considerar “professional”?

# 3. Workflow Git aplicat

## 3.1 Model de branques utilitzat

Hem utilitzat un model híbrid basat en **Feature Branch Workflow** amb branques personals.

### Estructura de branques

* `main` → versió estable i final del projecte
* `dev` → branca d’integració on es fusionen les funcionalitats
* `feature/*` → desenvolupament de noves funcionalitats
* `fix/*` → correcció d’errors
* `david`, `ivan`, `izan` → branques personals de desenvolupament

### Flux de treball aplicat

1. Cada alumne treballa en la seva branca personal (`david`, `ivan`, `izan`).
2. Les funcionalitats es desenvolupen dins aquestes branques o en branques `feature`.
3. Quan una funcionalitat està completada:

   * Es fa merge cap a `dev`.
4. Quan `dev` és estable:

   * Es fa merge cap a `main`.

Aquest model permet:

* Treball paral·lel sense interferències
* Control dels conflictes
* Separació entre desenvolupament i versió estable

---

## 3.2 Convencions de noms

### Branques

Hem utilitzat noms descriptius segons el tipus:

* `feature`
* `fix`
* `david`
* `ivan`
* `izan`

Les branques personals porten el nom de l’alumne per identificar responsabilitats.

---

## 3.3 Estratègia de merge utilitzada

Hem utilitzat `git merge` tradicional (no squash), mantenint l’historial complet.

Exemple:

```bash
git checkout dev
git merge ivan
```

Això genera un commit de merge visible a l’historial.

---

## 3.4 Ús de rebase

No s’ha utilitzat `git rebase` en el flux principal del projecte.

Motiu:

* Evitar reescriure l’historial compartit
* Facilitar el seguiment del procés
* Mantenir evidència clara dels conflictes per a la documentació

S’ha utilitzat únicament `git pull` per actualitzar branques abans de fer merge.

---

## 4. Conflicte 1 – Mateixa línia

### 4.1 Com s’ha provocat

Hem editat la linea de "Autor" al navbar cadascú a la seva branca i després hem fet un merge.

### 4.2 Missatge d’error generat

This branch has conflicts that must be resolved

Use the web editor or the command line to resolve conflicts before continuing.

### 4.3 Marcadors de conflicte
```
<<<<<<< ivan
    <a href="{{ route('autor_list') }}">Autors de llibre</a>
=======
    <a href="{{ route('autor_list') }}">Vista autores</a>
>>>>>>> main
```
### 4.4 Resolució aplicada

Expliqueu:

Li hem donat a l'opció "accept current", perquè volem la informació de la meva branca.

S'ha escollit aquesta perquè accept incoming faria que no es desin els canvis de la meva branca i posar l'opció de "accept both" faria que hi apareixin dos apartats

### 4.5 Reflexió

Hem après a identificar les marques de conflicte (<<<<<<<, =======, >>>>>>>) i a editar el codi correctament abans de fer el commit de resolució.

També hem entès la importància de coordinar-nos millor per evitar conflictes innecessaris.

## 5. Conflicte 2 – Dependències o estructura

### 5.1 Descripció del conflicte

Hem editat l'arxiu edit.llibre, cada un en la seva branca, un dels dos fa un rename del arxiu mentre que l'altre edita l'arxiu, en el nostre cas li hem canviat el títol.

### 5.2 Error generat

This branch has conflicts that must be resolved
Use the command line to resolve conflicts before continuing.

Ativitat_3_5/Ativitat_3_1_base/resources/views/llibre/edit.blade.php

En aquest conflicte la diferencia es que aquest tipus d'errors son mes complexes y no deixa tenir una resolucio mes sencilla que amb el primer error. 
En aquest cas, hem cambiat el nom de l'archiu y posteriorment hem editat contingut d'aquest fitxer y al fer merge ha aparegut el conflicte.

### 5.3 Resolució aplicada

La solucio que hem fet es fer fer pull y merge a les branques on estaben editant per que s'apliquin els cambis del nom de l'archiu y a partir d'aqui editar el contingut sense cap tipus de conflicte.

### 5.4 Diferències respecte al conflicte anterior

La diferencia entre els dos conflictes es que en el primer l'error deixava arreglarlo desde GitHub pero el segon com era per tema de dependencies aquesta opcio no estaba disponible en GitHub y hem tingut que arreglarlo a mà sense utilitzar Github.

## 6. Dockerització
### 6.1 Arquitectura final

L’aplicació s’ha dockeritzat utilitzant Docker Compose, que permet definir i executar diversos contenidors que funcionen conjuntament. En aquest projecte s’han definit dos serveis principals dins del fitxer docker-compose.yml: el servei de l’aplicació Laravel i el servei de base de dades MySQL.

#### Servei app

Aquest servei conté l’aplicació Laravel.

Característiques principals:

#### build
``` bash
build:
  context: .
  dockerfile: Dockerfile
```

Indica que la imatge del contenidor es construeix utilitzant el Dockerfile del projecte.

#### container_name

``` bash
container_name: laravel_app
```

Assigna un nom al contenidor per facilitar-ne la identificació.

#### ports

``` bash
ports:
  - "8080:8000"
```

Exposa el port 8000 del contenidor al port 8080 del sistema host, permetent accedir a l’aplicació des del navegador mitjançant:

http://localhost:8080

#### depends_on
``` bash
depends_on:
  - db
```

Indica que el servei app depèn del servei db, assegurant que el contenidor de la base de dades s’iniciï abans.

#### environment

Defineix les variables d’entorn necessàries perquè Laravel pugui connectar-se a la base de dades:

``` bash
DB_CONNECTION: mysql
DB_HOST: db
DB_PORT: 3306
DB_DATABASE: biblioteca
DB_USERNAME: laravel
DB_PASSWORD: laravel
```

El valor db en DB_HOST correspon al nom del servei de base de dades dins de Docker Compose, que és com els contenidors es comuniquen entre ells dins de la xarxa interna.

#### Servei db

Aquest servei executa la base de dades MySQL.

Configuració principal:

#### image

``` bash
image: mysql:8
```

Utilitza la imatge oficial de MySQL versió 8.

#### container_name

``` bash
container_name: laravel_db
```

Defineix el nom del contenidor.

#### restart

``` bash
restart: unless-stopped
```

Fa que el contenidor es reinici automàticament si s’atura inesperadament.

#### environment

Variables necessàries per inicialitzar la base de dades:

``` bash
MYSQL_DATABASE: biblioteca
MYSQL_USER: laravel
MYSQL_PASSWORD: laravel
MYSQL_ROOT_PASSWORD: root
```

Aquestes variables creen la base de dades i l’usuari que Laravel utilitzarà per connectar-s’hi.

#### ports

``` bash
- "3307:3306"
```

Permet accedir a MySQL des de l’ordinador host utilitzant el port 3307.

#### volumes

``` bash
- dbdata:/var/lib/mysql
```

Permet guardar les dades de la base de dades en un volum persistent.

### 6.2 Variables d’entorn

Les variables d’entorn permeten configurar l’aplicació sense modificar el codi font.

En aquest projecte s’utilitzen principalment per definir la configuració de connexió amb la base de dades.

Variable	    Funció
DB_CONNECTION	Tipus de base de dades utilitzada (MySQL)
DB_HOST	        Nom del servei de la base de dades
DB_PORT	        Port del servidor MySQL
DB_DATABASE	    Nom de la base de dades
DB_USERNAME	    Usuari de la base de dades
DB_PASSWORD	    Contrasenya de l’usuari

Laravel utilitza aquestes variables per establir la connexió amb la base de dades a través del seu sistema de configuració.

Per què no es versiona el fitxer .env?

El fitxer .env no es puja al repositori per diversos motius:

Conté informació sensible, com contrasenyes o claus d’accés.

Cada entorn (desenvolupament, proves o producció) pot necessitar configuracions diferents.

Permet que cada desenvolupador tingui la seva pròpia configuració local.

Per aquest motiu, habitualment es proporciona un fitxer .env.example amb les variables necessàries però sense dades sensibles.

### 6.3 Persistència

Per evitar que les dades de la base de dades es perdin quan els contenidors s’aturen o s’eliminen, s’utilitza un volum de Docker.

En el fitxer docker-compose.yml es defineix:

``` bash
volumes:
  dbdata:
```

Aquest volum s’utilitza en el servei de la base de dades:

``` bash
volumes:
  - dbdata:/var/lib/mysql
```

Això significa que:

Les dades de MySQL s’emmagatzemen a /var/lib/mysql dins del contenidor.

Aquest directori està connectat a un volum persistent anomenat dbdata.

Gràcies a això:

- Si el contenidor es reinicia o s’elimina, les dades de la base de dades es mantenen.

- Docker gestiona l’emmagatzematge de forma independent al contenidor.

### 6.4 Problemes trobats

Durant el procés de dockerització es van trobar alguns problemes habituals.

### Problema de connexió amb la base de dades

##### Error:
``` bash
SQLSTATE[HY000] [2002] Connection refused
```

##### Causa

L’aplicació intentava connectar-se a localhost, però dins de Docker els contenidors s’han de comunicar utilitzant el nom del servei.

##### Solució

Canviar el host de la base de dades a:

``` bash
DB_HOST=db
```
La base de dades no està preparada quan s’inicia Laravel

Encara que depends_on inicia primer el contenidor de la base de dades, no garanteix que MySQL estigui completament preparat per acceptar connexions.

Això pot provocar errors quan Laravel intenta connectar-se.

##### Solució

Reconstruir i reiniciar els contenidors amb:

``` bash
docker compose up --build
```

### Instal·lació de dependències PHP

Algunes dependències necessàries per Laravel no estaven disponibles inicialment.

#### Solució

Instal·lar les extensions necessàries al Dockerfile:

``` bash
docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath
```

Aquestes extensions són requerides per Laravel i per alguns dels seus paquets.

## 7. Prova de desplegament des de zero

  Expliqueu els passos exactes que hauria de seguir una persona externa:
- Clonar repositori
- Executar comanda
- Accedir a l’aplicació  

Indiqueu també:
- Ports utilitzats
- Credencials de prova (si n’hi ha)

## 8. Repartiment de tasques

- Izan -> Creació projecte/repositori, dockerització, documentació i ajuda a fer els conflictes.
- David -> Conflicte 2, documentació i creació de branques.
- Iván -> Conflicte 1, documentació, adaptació del workflow i prova de desplegament des de zero.

## 9. Temps invertit

- Temps dedicat a Git -> 4h
- Temps dedicat a Docker -> 2h
- Temps dedicat a documentació -> 2h

## 10. Reflexió final

Responeu breument:

- Quina ha estat la part més complexa?
- Què faríeu diferent en un projecte real?
- Heu entès realment com funcionen els conflictes i Docker?







