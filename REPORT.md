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

La solució que hem fet és fer pull i merge a les branques on estaven editant perquè s'apliquin els canvis del nom de l'arxiu i a partir d'aquí editar el contingut sense cap classe de conflicte.

## 6. Dockerització

### 6.1 Arquitectura final

Descriviu els serveis definits a docker-compose.yml.

### 6.2 Variables d’entorn

Expliqueu quines variables són necessàries i per què no es versiona el .env.

### 6.3 Persistència (si s'escau)

Expliqueu l’ús de volums.

###  6.4 Problemes trobats

Incloeu errors reals i com s’han resolt.

## 7. Prova de desplegament des de zero

  Expliqueu els passos exactes que hauria de seguir una persona externa:
- Clonar repositori
- Executar comanda
- Accedir a l’aplicació  

Indiqueu també:
- Ports utilitzats
- Credencials de prova (si n’hi ha)

## 8. Repartiment de tasques

Descriviu què ha fet cada membre de l’equip.

## 9. Temps invertit

Indiqueu aproximadament:
- Temps dedicat a Git
- Temps dedicat a Docker
- Temps dedicat a documentació

## 10. Reflexió final

Responeu breument:

- Quina ha estat la part més complexa?
- Què faríeu diferent en un projecte real?
- Heu entès realment com funcionen els conflictes i Docker?





