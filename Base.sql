DROP VIEW IF EXISTS V_PATIENT_ACTE_DETAIL_ACTE CASCADE;

DROP VIEW IF EXISTS BENEFICE CASCADE;

DROP VIEW IF EXISTS REALISATION_RECETTES CASCADE;

DROP VIEW IF EXISTS REALISATION_DEPENSES CASCADE;

DROP VIEW IF EXISTS TOTALE_DEPENSE_MOIS_ANNEE CASCADE;

DROP VIEW IF EXISTS TOTALE_RECETTE_MOIS_ANNEE CASCADE;

DROP VIEW IF EXISTS RECETTE_MOIS_ANNEE CASCADE;

DROP VIEW IF EXISTS DEPENSE_MOIS_ANNEE CASCADE;

DROP VIEW IF EXISTS V_PATIENT_ACTE CASCADE;

DROP VIEW IF EXISTS V_PATIENT CASCADE;

DROP VIEW IF EXISTS LISTE_FACTURE CASCADE;

DROP TABLE IF EXISTS GENRE CASCADE;

CREATE TABLE GENRE(
    ID SERIAL PRIMARY KEY,
    GENRE VARCHAR(50) NOT NULL
);

CREATE TABLE MOIS(
    ID SERIAL PRIMARY KEY,
    MOIS VARCHAR(50) NOT NULL
);

---////////////////////////////////---
CREATE
OR REPLACE VIEW V_PATIENT AS

SELECT
    P.ID,
    P.NOM,
    P.DATENAISSANCE,
    P.REMBOURSEMENT,
    G.GENRE
FROM
    PATIENTS P
    JOIN GENRE G
    ON P.GENREID = G.ID;

---////////////////////////////////---
CREATE
OR REPLACE VIEW V_PATIENT_ACTE AS

SELECT
    PA.ID,
    PAD.ACTEID,
    A.NOM                                                                                     AS ACTE,
    CASE
        WHEN P.REMBOURSEMENT = 0 THEN
            PAD.MONTANT + (0.2 * PAD.MONTANT)
        ELSE
            PAD.MONTANT
    END AS MONTANT,
    PAD.PATIENTACTEID,
    P.NOM                                                                                     AS PATIENT,
    PA.CREATED_AT
FROM
    PATIENT_ACTE_DETAILS PAD
    JOIN PATIENT_ACTES PA
    ON PA.ID = PAD.PATIENTACTEID JOIN ACTES A
    ON A.ID = PAD.ACTEID
    JOIN PATIENTS P
    ON P.ID = PA.PATIENTID;

---////////////////////////////////---
CREATE OR REPLACE VIEW LISTE_FACTURE AS
    SELECT
        ID,
        CREATED_AT   AS DATEFACTURE,
        SUM(MONTANT)AS MONTANT
    FROM
        V_PATIENT_ACTE
    GROUP BY
        (ID,
        CREATED_AT);

---////////////////////////////////---
CREATE
OR REPLACE VIEW TOTALE_ACTE AS

SELECT
    PA.ID,
    SUM(MONTANT) AS TOTALE
FROM
    V_PATIENT_ACTE PA
GROUP BY
    PA.ID;

---////////////////////////////////---
-- CREATE

-- OR REPLACE VIEW DEPENSE_MOIS_ANNEE AS

-- SELECT
--     MONTHS.MONTH AS MONTH,
--     MONTHS.YEAR  AS YEAR,
--     TD.ID        AS TYPEDEPENSEID,
--     TD.NOM       AS DEPENSE,
--     COALESCE(SUM(D.MONTANT),
--     0)           AS MONTANT
-- FROM
--     (
--         SELECT
--             EXTRACT( MONTH
--         FROM
--             CREATED_AT ) AS MONTH,
--             EXTRACT( YEAR FROM CREATED_AT ) AS YEAR
--         FROM
--             DEPENSES
--         GROUP BY
--             EXTRACT( MONTH FROM CREATED_AT ),
--             EXTRACT( YEAR FROM CREATED_AT )
--     )             MONTHS
--     CROSS JOIN TYPE_DEPENSES TD
--     LEFT JOIN DEPENSES D
--     ON MONTHS.MONTH = EXTRACT( MONTH FROM D.CREATED_AT )
--     AND MONTHS.YEAR = EXTRACT( YEAR FROM D.CREATED_AT )
--     AND TD.ID = D.TYPEDEPENSEID
-- GROUP BY
--     MONTHS.MONTH,
--     MONTHS.YEAR,
--     TD.ID,
--     TD.NOM;
CREATE OR REPLACE VIEW DEPENSE_MOIS_ANNEE AS
    SELECT
        CALENDAR.MONTH,
        CALENDAR.YEAR,
        TD.ID AS TYPEDEPENSEID,
        TD.NOM AS DEPENSE,
        COALESCE(SUM(D.MONTANT),
        0) AS MONTANT
    FROM
        (
            SELECT
                M.MONTH,
                Y.YEAR
            FROM
                GENERATE_SERIES(2000,
                2050) Y(YEAR),
                GENERATE_SERIES(1,
                12) M(MONTH)
        ) CALENDAR
        CROSS JOIN TYPE_DEPENSES TD
        LEFT JOIN DEPENSES D
        ON TD.ID = D.TYPEDEPENSEID
        AND EXTRACT(MONTH FROM D.CREATED_AT) = CALENDAR.MONTH
        AND EXTRACT(YEAR FROM D.CREATED_AT) = CALENDAR.YEAR
    GROUP BY
        CALENDAR.MONTH,
        CALENDAR.YEAR,
        TD.ID,
        TD.NOM;

---////////////////////////////////---

-- CREATE

-- OR REPLACE VIEW RECETTE_MOIS_ANNEE AS

-- SELECT
--     MONTHS.MONTH AS MONTH,
--     MONTHS.YEAR  AS YEAR,
--     ACTS.ID      AS ACTEID,
--     ACTS.NOM     AS ACTE,
--     COALESCE(SUM(PAD.MONTANT),
--     0)           AS MONTANT
-- FROM
--     (
--         SELECT
--             EXTRACT( MONTH
--         FROM
--             CREATED_AT ) AS MONTH,
--             EXTRACT( YEAR FROM CREATED_AT ) AS YEAR
--         FROM
--             PATIENT_ACTES
--         GROUP BY
--             EXTRACT( MONTH FROM CREATED_AT ),
--             EXTRACT( YEAR FROM CREATED_AT )
--     )                    MONTHS
--     CROSS JOIN ACTES ACTS
--     LEFT JOIN PATIENT_ACTE_DETAILS PAD
--     ON MONTHS.MONTH = EXTRACT( MONTH FROM PAD.CREATED_AT )
--     AND MONTHS.YEAR = EXTRACT( YEAR FROM PAD.CREATED_AT )
--     AND ACTS.ID = PAD.ACTEID
-- GROUP BY
--     MONTHS.MONTH,
--     MONTHS.YEAR,
--     ACTS.ID,
--     ACTS.NOM;
CREATE OR REPLACE VIEW RECETTE_MOIS_ANNEE AS
    SELECT
        CALENDAR.MONTH,
        CALENDAR.YEAR,
        ACTES.ID AS ACTEID,
        ACTES.NOM AS ACTE,
        COALESCE(SUM(PAD.MONTANT),
        0) AS MONTANT
    FROM
        (
            SELECT
                M.MONTH,
                Y.YEAR
            FROM
                GENERATE_SERIES(2000,
                2050) Y(YEAR),
                GENERATE_SERIES(1,
                12) M(MONTH)
        ) CALENDAR
        CROSS JOIN ACTES
        LEFT JOIN V_PATIENT_ACTE PA
        ON EXTRACT(MONTH FROM PA.CREATED_AT) = CALENDAR.MONTH
        AND EXTRACT(YEAR FROM PA.CREATED_AT) = CALENDAR.YEAR
        AND PA.ACTEID = ACTES.ID
        LEFT JOIN PATIENT_ACTE_DETAILS PAD
        ON PAD.PATIENTACTEID = PA.ID
    GROUP BY
        CALENDAR.MONTH,
        CALENDAR.YEAR,
        ACTES.ID,
        ACTES.NOM;

---////////////////////////////////---
CREATE
OR REPLACE VIEW REALISATION_RECETTES AS

SELECT
    RMA.MONTH AS MONTH,
    RMA.YEAR AS YEAR,
    RMA.ACTEID,
    RMA.ACTE,
    RMA.MONTANT,
    (A.BUDGETANNUEL / 12)::DECIMAL(10,
    2) AS BUDGET_MENSUEL,
    ((RMA.MONTANT / (A.BUDGETANNUEL / 12)) * 100)::DECIMAL(10,
    2) AS REALISATION
FROM
    RECETTE_MOIS_ANNEE RMA
    JOIN ACTES A
    ON A.ID = RMA.ACTEID;

---////////////////////////////////---
CREATE
OR REPLACE VIEW REALISATION_DEPENSES AS

SELECT
    DMA.MONTH AS MONTH,
    DMA.YEAR AS YEAR,
    DMA.TYPEDEPENSEID,
    DMA.DEPENSE,
    DMA.MONTANT,
    (TD.BUDGETANNUEL / 12)::DECIMAL(10,
    2) AS BUDGET_MENSUEL,
    ((DMA.MONTANT / (TD.BUDGETANNUEL / 12)) * 100)::DECIMAL(10,
    2) AS REALISATION
FROM
    DEPENSE_MOIS_ANNEE DMA
    JOIN TYPE_DEPENSES TD
    ON DMA.TYPEDEPENSEID = TD.ID;

---////////////////////////////////---
CREATE
OR REPLACE VIEW TOTALE_DEPENSE_MOIS_ANNEE AS

SELECT
    MONTH,
    YEAR,
    SUM(MONTANT) AS TOTALEDEPENSE,
    SUM(BUDGET_MENSUEL) AS TOTALEBUDGET_MENSUEL,
    ((SUM(MONTANT) / SUM(BUDGET_MENSUEL)) * 100)::DECIMAL(10,
    2) AS TOTALEREALISATION
FROM
    REALISATION_DEPENSES
GROUP BY
    (MONTH,
    YEAR);

---////////////////////////////////---
CREATE
OR REPLACE VIEW TOTALE_RECETTE_MOIS_ANNEE AS

SELECT
    MONTH,
    YEAR,
    SUM(MONTANT) AS TOTALERECETTE,
    (SUM(BUDGET_MENSUEL))::DECIMAL(10,
    2) AS TOTALEBUDGET_MENSUEL,
    ((SUM(MONTANT) / SUM(BUDGET_MENSUEL)) * 100)::DECIMAL(10,
    2) AS TOTALEREALISATION
FROM
    REALISATION_RECETTES
GROUP BY
    (MONTH,
    YEAR);

---////////////////////////////////---
CREATE OR REPLACE VIEW BENEFICE AS
    SELECT
        TR.MONTH,
        TR.YEAR,
        TR.TOTALERECETTE AS TOTALERECETTE,
        TD.TOTALEDEPENSE AS TOTALEDEPENSE,
        TR.TOTALEBUDGET_MENSUEL AS TOTALERECETTEBUDGET_MENSUEL,
        TD.TOTALEBUDGET_MENSUEL AS TOTALEDEPENSEBUDGET_MENSUEL,
        TR.TOTALERECETTE - TD.TOTALEDEPENSE AS BENEFICEREEL,
        TR.TOTALEBUDGET_MENSUEL - TD.TOTALEBUDGET_MENSUEL AS BENEFICEBUDGET_MENSUEL,
        ((TR.TOTALERECETTE / TR.TOTALEBUDGET_MENSUEL)*100)::DECIMAL(10,
        2) AS REALISATIONRECETTE,
        ((TD.TOTALEDEPENSE / TD.TOTALEBUDGET_MENSUEL)*100)::DECIMAL(10,
        2) AS REALISATIONDEPENSE,
        (((TR.TOTALERECETTE - TD.TOTALEDEPENSE)/(TR.TOTALEBUDGET_MENSUEL - TD.TOTALEBUDGET_MENSUEL))*100)::DECIMAL(10,
        2) AS REALISATIONBENEFICE
    FROM
        TOTALE_RECETTE_MOIS_ANNEE TR
        JOIN TOTALE_DEPENSE_MOIS_ANNEE TD
        ON TR.MONTH = TD.MONTH
        AND TR.YEAR = TD.YEAR
    GROUP BY
        (TR.MONTH, TR.YEAR, TOTALERECETTE, TOTALEDEPENSE, TOTALERECETTEBUDGET_MENSUEL, TOTALEDEPENSEBUDGET_MENSUEL);

---////////////////////////////////---
CREATE OR REPLACE VIEW V_PATIENT_ACTE_DETAIL_ACTE AS
    SELECT
        EXTRACT( YEAR FROM CREATED_AT ) AS YEAR,
        EXTRACT( MONTH FROM CREATED_AT ) AS MONTH,
        ACTEID,
        ACTE,
        SUM(MONTANT)                     AS MONTANT
    FROM
        V_PATIENT_ACTE
    GROUP BY
        (MONTH,
        YEAR,
        ACTEID,
        ACTE);

---////////////////////////////////---
----------------------------------------------------------------
INSERT INTO GENRE VALUES (
    DEFAULT,
    'Homme'
),
(
    DEFAULT,
    'Femme'
);

INSERT INTO MOIS VALUES(
    DEFAULT,
    'JANVIER'
),
(
    DEFAULT,
    'FEVRIER'
),
(
    DEFAULT,
    'MARS'
),
(
    DEFAULT,
    'AVRIL'
),
(
    DEFAULT,
    'MAIS'
),
(
    DEFAULT,
    'JUIN'
),
(
    DEFAULT,
    'JUILLET'
),
(
    DEFAULT,
    'AOUT'
),
(
    DEFAULT,
    'SEPTEMBRE'
),
(
    DEFAULT,
    'OCTOBRE'
),
(
    DEFAULT,
    'NOVEMBRE'
),
(
    DEFAULT,
    'DECEMBRE'
);

INSERT INTO EMPLOYES VALUES (
    DEFAULT,
    'Test',
    'test@gmail.com',
    '123456789',
    '2023-07-18 06:42:51',
    '2023-07-18 06:42:51'
);

--------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE EMPLOYEES (
    ID SERIAL PRIMARY KEY,
    NAME VARCHAR(255),
    AGE INTEGER,
    SALARY NUMERIC(10, 2)
);

ALTER TABLE EMPLOYEES ADD COLUMN DEPARTMENT VARCHAR(255);