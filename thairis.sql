-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 17 มิ.ย. 2024 เมื่อ 01:50 AM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.6.17-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thairis1_thairisfree`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_api_client`
--

CREATE TABLE `xray_api_client` (
  `ID` int(2) NOT NULL,
  `CLIENT_ID` varchar(50) DEFAULT NULL,
  `CLIENT_TOKEN` varchar(100) DEFAULT NULL,
  `API_ORM_IN` int(1) DEFAULT 1,
  `API_ORM_OUT` int(1) DEFAULT 1,
  `API_ORU_IN` int(1) DEFAULT 1,
  `API_ORU_OUT` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_api_client`
--

INSERT INTO `xray_api_client` (`ID`, `CLIENT_ID`, `CLIENT_TOKEN`, `API_ORM_IN`, `API_ORM_OUT`, `API_ORU_IN`, `API_ORU_OUT`) VALUES
(1, 'ABCDE', '44654654654654654654655656564646454665646', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_auto`
--

CREATE TABLE `xray_auto` (
  `ID` int(11) NOT NULL,
  `LAST_REQUEST_NO` varchar(10) NOT NULL,
  `YEAR` year(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_auto`
--

INSERT INTO `xray_auto` (`ID`, `LAST_REQUEST_NO`, `YEAR`) VALUES
(1, '27', 2024);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_billing`
--

CREATE TABLE `xray_billing` (
  `ID` int(11) NOT NULL,
  `XRAY_BILL_NO` varchar(10) NOT NULL,
  `REQUEST_NO` varchar(10) NOT NULL,
  `XRAY_CODE` varchar(30) NOT NULL,
  `XRAY_PRICE` int(10) UNSIGNED NOT NULL,
  `DF` int(10) UNSIGNED DEFAULT NULL,
  `CHARGED` int(1) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_birad`
--

CREATE TABLE `xray_birad` (
  `ID` int(2) NOT NULL,
  `BIRAD` varchar(10) NOT NULL,
  `LEVEL` varchar(1) NOT NULL,
  `DESCRIPTION` varchar(60) NOT NULL,
  `DETAIL` varchar(200) NOT NULL,
  `DETAIL_THAI` varchar(200) NOT NULL,
  `FOLLOW_UP` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_birad`
--

INSERT INTO `xray_birad` (`ID`, `BIRAD`, `LEVEL`, `DESCRIPTION`, `DETAIL`, `DETAIL_THAI`, `FOLLOW_UP`) VALUES
(1, 'BI-RADS 0', '0', 'BI-RADS 0 : Incomplete assessment ', 'Your mammogram or ultrasound didn\'t give the radiologist enough information to make a clear diagnosis; follow-up imaging is necessary', '', ''),
(2, 'BI-RADS 1', '1', 'BI-RADS 1 : Negative finding(s) (within normal) ', 'There is nothing to comment on; routine screening recommended', '', ''),
(3, 'BI-RADS 2', '2', 'BI-RADS 2 : Benign finding(s)', 'A definite benign finding; routine screening recommended', '', ''),
(4, 'BI-RADS 3', '3', 'BI-RADS 3 : Probably benign finding(s), 12-months follow-up', 'Findings that have a high probability of being benign (>98%); 12-month short interval follow-up', '', ''),
(5, 'BI-RADS 4', '4', 'BI-RADS 4 : Suspicious abnormality, biopsy recommend ', 'Not characteristic of breast cancer, but reasonable probability of being malignant (3 to 94%); biopsy should be considered', '', ''),
(6, 'BI-RADS 5', '5', 'BI-RADS 5 : Highly suggestive of malignancy ', 'Lesion that has a high probability of being malignant (>= 95%); take appropriate action', '', ''),
(7, 'BI-RADS 6', '6', 'BI-RADS 6 : Known Biopsy Proven Malignancy', 'Lesions known to be malignant that are being imaged ', '', '');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_body_part`
--

CREATE TABLE `xray_body_part` (
  `ID` int(11) NOT NULL,
  `BODY_PART` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_body_part`
--

INSERT INTO `xray_body_part` (`ID`, `BODY_PART`) VALUES
(1, '-'),
(2, 'CHEST'),
(3, 'HEAD'),
(4, 'LOWER EXTREMITY'),
(5, 'MAMMO'),
(6, 'NECK'),
(7, 'OTHER'),
(8, 'PELVIS'),
(9, 'SHOULDER'),
(10, 'SPINE'),
(11, 'UPPER EXTREMITY'),
(12, 'ABDOMEN'),
(13, 'SOFT TISSUE');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_center`
--

CREATE TABLE `xray_center` (
  `ID` int(3) NOT NULL,
  `CODE` varchar(20) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `NAME_ENG` varchar(50) DEFAULT NULL,
  `REPORTLOGO` varchar(50) DEFAULT NULL,
  `ACTIVE` int(1) NOT NULL DEFAULT 1,
  `PACS_URL1` varchar(200) DEFAULT NULL,
  `PACS_URL2` varchar(200) DEFAULT NULL,
  `CREATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `EMAIL` varchar(100) DEFAULT NULL,
  `FAX` varchar(20) DEFAULT NULL,
  `EXTERNAL_ID` varchar(30) DEFAULT NULL,
  `ENABLE_LOGO` int(1) NOT NULL DEFAULT 1,
  `ADDRESS` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_center`
--

INSERT INTO `xray_center` (`ID`, `CODE`, `NAME`, `NAME_ENG`, `REPORTLOGO`, `ACTIVE`, `PACS_URL1`, `PACS_URL2`, `CREATE_TIME`, `EMAIL`, `FAX`, `EXTERNAL_ID`, `ENABLE_LOGO`, `ADDRESS`) VALUES
(1, 'CENTRAL', 'RIS', 'RIS', 'banner-report.jpg', 1, NULL, NULL, '2021-10-01 14:13:55', 'info.xraythai@gmail.com', '1254875633', '3333', 1, '222/22 Bangkoknoi, Wanglung Road, Bangcharnglor, Bangkok 10700 Tel:123457890 email:info.xraythai@gmail.com');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_code`
--

CREATE TABLE `xray_code` (
  `CENTER` varchar(10) NOT NULL,
  `XRAY_CODE` varchar(30) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL,
  `XRAY_TYPE_CODE` varchar(50) NOT NULL,
  `BODY_PART` varchar(15) DEFAULT NULL,
  `CHARGE_TOTAL` float UNSIGNED DEFAULT NULL,
  `PORTABLE_CHARGE` int(4) DEFAULT NULL,
  `DF` int(5) UNSIGNED DEFAULT NULL,
  `TIME_USE` int(3) UNSIGNED DEFAULT NULL,
  `BIRAD_FLAG` varchar(1) NOT NULL DEFAULT '0',
  `PREP_ID` varchar(10) DEFAULT NULL,
  `DELETE_FLAG` int(1) NOT NULL DEFAULT 0,
  `ACTIVE` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_code`
--

INSERT INTO `xray_code` (`CENTER`, `XRAY_CODE`, `DESCRIPTION`, `XRAY_TYPE_CODE`, `BODY_PART`, `CHARGE_TOTAL`, `PORTABLE_CHARGE`, `DF`, `TIME_USE`, `BIRAD_FLAG`, `PREP_ID`, `DELETE_FLAG`, `ACTIVE`) VALUES
('CENTRAL', 'B0101', 'TORAX (PA UPRIGHT) Portable', 'XRAY', 'TORAX', 2500000, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0102', 'CHEST PA  - ONE VIEW', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0103', 'CHEST AP - ONE VIEW', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0104', 'CHEST PA AND LAT - TWO VIEW2', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0105', 'CHEST AP AND LAT - TWO VIEW', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0106', 'CHEST-LT(LAT DECUBITUS)', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0107', 'CHEST APICAL LORDOTIC', 'XRAY', 'CHEST', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0108', 'CHEST-RT(AP OBLIQUE)', 'XRAY', 'CHEST', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0109', 'CHEST-LT(AP OBLIQUE)', 'XRAY', 'CHEST', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0202', 'RIB - RT 2-3 VIEWS', 'XRAY', 'CHEST', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0203', 'RIB-LT 2-3 VIEWS', 'XRAY', 'CHEST', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0204', 'RIB-BILAT W/ OBLIQUES', 'XRAY', 'CHEST', 0, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0205', 'RIB-RT(PA, OBLIQUE)', 'XRAY', 'CHEST', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'B0206', 'RIB-LT(PA, OBLIQUE)', 'XRAY', 'CHEST', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'B0207', 'RIB(PA FOR CHEST, BOTH OBLIQUE) ', 'XRAY', 'CHEST', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0208', 'RIB RT(PA  FOR CHEST, OBLIQUE) ', 'XRAY', 'CHEST', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0209', 'RIB LT(PA FOR CHEST, OBLIQUE) ', 'XRAY', 'CHEST', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0301', 'CLAVICLE-RT', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0302', 'CLAVICLE-LT', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0705', 'SCAPULAR-RT(AP, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0706', 'SCAPULAR-LT(AP, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0707', 'SCAPULAR-BOTH(AP, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0801', 'ABDOMEN(UPRIGHT)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0802', 'ABDOMEN(SUPINE)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0803', 'ABDOMEN(LAT)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0804', 'ABDOMEN(SUPINE, UPRIGHT)', 'XRAY', 'ABDOMEN', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B0805', 'ACUTE ABDOMEN SERIES(CHEST,ABDOMEN)', 'XRAY', 'ABDOMEN', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'B0806', 'ABDOMEN-RT(LAT DECUBITUS)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0807', 'ABDOMEN-LT(LAT DECUBITUS)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0808', 'ABDOMEN-RT(DORSAL  DECUBITUS)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0809', 'ABDOMEN-LT(DORSAL  DECUBITUS)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0810', 'ABDOMEN-(LAT CROSSTABLE)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B0901', 'PLAIN KUB(AP)', 'XRAY', 'ABDOMEN', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B0902', 'KUB AND LAT LS SPINE', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'B1001', 'PELVIS(AP)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B1002', 'PELVIS(FROG LEG)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B1003', 'PELVIS(AP,FROG LEG)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B1004', 'PELVIS(JUDET\'S VIEW)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B1005', 'PELVIS(AP, JUDET\'S VIEW)', 'XRAY', 'PELVIS', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B1006', 'PELVIS(INLET,OUTLET VIEW)', 'XRAY', 'PELVIS', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'B1007', 'PELVIS RT OBLIQUE', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B1008', 'PELVIS LT OBLIQUE', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'B1009', 'PELVIS BILAT OBLIQUE', 'XRAY', 'PELVIS', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'BD101', 'BONE DENSITY-FORARM-RT', 'BMD', 'UPPER', 4000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'BD102', 'BONE DENSITY- FORARM-LT', 'BMD', 'UPPER EXTREMITY', 2000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'BD103', 'BONE DENSITY-HIP-RT', 'BMD', 'PELVIS', 2000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'BD104', 'BONE DENSITY-HIP-LT', 'BMD', 'PELVIS', 2000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'BD105', 'BONE DENSITY-HIP-BOTH', 'BMD', 'PELVIS', 2000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'BD106', 'BONE DENSITY-LUMBAR SPINE-AP', 'BMD', 'SPINE', 2000, 0, 500, 20, '0', '', 1, 0),
('CENTRAL', 'C0110', 'BRAIN WITHOUT CONTRAST', 'CT', 'HEAD', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0111', 'BRAIN WITH CONTRAST', 'CT', 'HEAD', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0201', 'TEMPORAL BONE', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0202', 'PARANASAL SINUSES', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0203', 'BRAIN W/WO CONTRAST', 'CT', 'HEAD', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0204', 'FACIAL BONES', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0205', 'ORBITS', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0206', 'NECK W/O CONTRAST', 'CT', 'NECK', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0207', 'NECK W & WO CONTRAST', 'CT', 'NECK', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0208', 'NECK WITH CONTRAST', 'CT', 'NECK', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0209', 'BONE MINERAL DENSITY', 'CT', 'SPINE', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0210', 'ORAL CAVITY', 'CT', 'NECK', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0211', 'OROPHARYNX', 'CT', 'NECK', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0212', 'CT HEAD AND NECK(TUMOR+NODAL STAGING)', 'CT', 'HEAD', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C0301', 'DENTAL MAXILLA', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0302', 'DENTAL MANDIBLE', 'CT', 'HEAD', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0401', 'CERVICAL  SPINE ', 'CT', 'SPINE', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0402', 'CT CERVICAL  SPINE AND DYNAMIC', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C0403', 'THORACIC SPINE', 'CT', 'SPINE', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0404', 'CT THORACOLUMBAR SPINE', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C0405', 'LUMBAR SPINE', 'CT', 'SPINE', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0406', 'CT WHOLE SPINE', 'CT', 'SPINE', 5000, 0, 1000, 30, '0', '', 1, 0),
('CENTRAL', 'C0407', 'SACRUM AND COCCYX', 'CT', 'SPINE', 0, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'C0501', 'CHEST W/O CONTRAST', 'CT', 'CHEST', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0502', 'CHEST WITH CONTRAST', 'CT', 'CHEST', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0503', 'CT CHEST FOR PULMONARY EMBOLIZATION', 'CT', 'CHEST', 5000, 0, 1000, 30, '0', '', 1, 0),
('CENTRAL', 'C0504', 'CT HRCT', 'CT', 'CHEST', 5000, 0, 1000, 30, '0', '', 1, 0),
('CENTRAL', 'C0505', 'CHEST W & WO CONTRAST', 'CT', 'CHEST', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0601', 'CORONARY ARTERY CALCIUM SCORE', 'CT', '', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0602', 'CTA CORONARY(ROUTINE)', 'CT', '', 5000, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'C0603', 'CTA CORONARY TRIPLE R/O', 'CT', '', 5000, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'C0604', 'CTA CORONARY GRAFT EVALUATION', 'CT', '', 5000, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'C0701', 'ABDOMEN W/O CONTRAST', 'CT', 'ABDOMEN', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0702', 'ABDOMEN WITH CONTRAST', 'CT', 'ABDOMEN', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0703', 'ABDOMEN & PELVIS W/O CONTRAST', 'CT', 'ABDOMEN', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0704', 'ABDOMEN & PELVIS WITH CONTRAST', 'CT', '', 5000, 0, 0, 40, '0', '', 0, 1),
('CENTRAL', 'C0705', 'ABDOMEN & PELVIS W/WO CONTRAST', 'CT', '', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0706', 'UROGRAM W/WO CONTRAST', 'CT', 'ABDOMEN', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0707', 'PELVIS WO CONTRAST', 'CT', '', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0708', 'VIRTUAL COLONOSCOPY', 'CT', '', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C0709', 'FULL BODY', 'CT', '', 0, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'C0801', 'SHOULDER', 'CT', 'SHOULDER', 5000, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'C0802', 'CT HUMERUS', 'CT', 'UPPER EXTREMITY', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1203', 'PELVIS WITH CONTRAST', 'CT', '', 0, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1204', 'CTA LIVER (ONLY)', 'CT', '', 5000, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1205', 'CTA CAELIAC /SMA /IMA (ONLY)', 'CT', '', 5000, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1301', 'CTA RENAL DIALYSIS SHUNT EVALUATION (ONLY)', 'CT', '', 5000, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1302', 'CTA HUMERUS (ONLY)', 'CT', 'UPPER EXTREMITY', 5000, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1303', 'CTA PERIPHERAL  RUN OFF (ONLY)', 'CT', '', 5000, 0, 1000, 60, '0', '', 0, 1),
('CENTRAL', 'C1401', 'CT-SCREENING LUNG CANCER(LOW DOSE)', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1402', 'CT-SCREENING ACUTE ABDOMEN ', 'CT', 'ABDOMEN', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1403', 'CT-SCREENING LIVER CANCER', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1404', 'CT-SCREENING KUB STONE', 'CT', 'ABDOMEN', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1405', 'CT-SCREENING PARANASAL SINUSES', 'CT', 'HEAD', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1501', 'CT TOTAL BODY TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1502', 'CT BRAIN TRAUMA', 'CT', 'HEAD', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1503', 'CT CERVICAL SPINES TRAUMA', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1504', 'FULL BODY WITH CONTRAST', 'CT', 'SPINE', 0, 0, 1000, 15, '0', '', 0, 1),
('CENTRAL', 'C1505', 'CT THORACOLUMBAR SPINE TRAUMA', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1506', 'CT LUMBROSACRAL SPINE TRAUMA', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1507', 'CT SACRUM TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1508', 'CT WHOLE SPINE TRAUMA', 'CT', 'SPINE', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1509', 'CT THORAX TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1510', 'CT ABDOMINAL TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1511', 'CT UPPER EXTREMITY TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'C1512', 'CT LOWER EXTREMITY TRAUMA', 'CT', '', 5000, 0, 1000, 15, '0', '', 1, 0),
('CENTRAL', 'E0101', 'SHOULDER-RT 2V', 'XRAY', 'SHOULDER', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0102', 'SHOULDER-LT 2V', 'XRAY', 'SHOULDER', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0103', 'SHOULDER - BILAT, 2V EACH', 'XRAY', 'SHOULDER', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0104', 'SHOULDER-RT( INT, EXT ROTATION)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0105', 'SHOULDER-LT( INT, EXT ROTATION)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0106', 'SHOULDER-RT(TRANSAXILLA)', 'XRAY', 'SHOULDER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0107', 'SHOULDER-LT(TRANSAXILLA)', 'XRAY', 'SHOULDER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0108', 'SHOULDER-RT(TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0109', 'SHOULDER-LT(TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0110', 'SHOULDER-RT(AP, TRANSAXILLA)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0111', 'SHOULDER-LT(AP, TRANSAXILLA)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0112', 'SHOULDER-RT(AP, TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0113', 'SHOULDER-LT(AP, TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0114', 'SHOULDER-RT(AP,TRANSAXILLA,TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0115', 'SHOULDER-LT(AP,TRANSAXILLA,TRANSCAPULAR)', 'XRAY', 'SHOULDER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0116', 'SHOULDER-RT(AP CAUDAL 30 DEGREE)', 'XRAY', 'SHOULDER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0303', 'FOREARM-RT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'E0304', 'FOREARM-LT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'E0305', 'FOREARM-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0306', 'FOREARM-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0307', 'FOREARM - BILAT 2V EACH', 'XRAY', 'UPPER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0308', 'FOREARM INCLUDE ELBOW-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'E0309', 'FOREARM INCLUDE ELBOW-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'E0401', 'ELBOW-RT(AP)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0402', 'ELBOW-LT(AP)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0403', 'ELBOW-RT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0404', 'ELBOW-LT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0405', 'ELBOW-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0406', 'ELBOW-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0407', 'ELBOW-RT(OBLIQUE INT,EXT ROTATION)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0408', 'ELBOW-LT(OBLIQUE INT,EXT ROTATION)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0501', 'WRIST-RIGHT 2-3V', 'XRAY', 'UPPER', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0502', 'WRIST-LEFT 2-3V', 'XRAY', 'UPPER', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0503', 'WRIST-BILAT 2-3V EACH', 'XRAY', 'UPPER', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0504', 'WRIST-RT SCAPHOID VIEW', 'XRAY', 'UPPER', 10, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0505', 'WRIST-LT SCAPHOID VIEW', 'XRAY', 'UPPER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0506', 'WRIST-BOTH(LAT)(H) ', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0507', 'WRIST-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0508', 'WRIST-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0509', 'WRIST-LT(AP, LAT,ULNAR DEVIATION)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0510', 'WRIST-RT(AP, LAT,ULNAR DEVIATION)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0511', 'CARPAL SERIES-RT(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0512', 'CARPAL SERIES-LT(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0513', 'CARPAL TUNNEL-RT(TANGENTIAL)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0514', 'CARPAL TUNNEL-LT(TANGENTIAL)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0515', 'CARPAL BRIDGE-RT(TANGENTIAL)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0516', 'CARPAL BRIDGE-LT(TANGENTIAL)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0601', 'HAND RIGHT 3V', 'XRAY', 'UPPER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0602', 'HAND RIGH 2V', 'XRAY', 'UPPER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0603', 'HAND-BOTH(AP)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0604', 'HAND-RT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0605', 'HAND-LT(LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0606', 'HAND-RT(AP,OBLIQUE)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0607', 'HAND-LT(AP,OBLIQUE)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0608', 'HAND-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'E0609', 'HAND-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0610', 'HAND-BOTH(AP OBLIQUE BILAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0701', 'THUMB FINGER-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0702', 'THUMB FINGER-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0801', 'INDEX FINGER-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0802', 'INDEX FINGER-LT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'E0901', 'MIDDLE FINGER-RT(AP, LAT)', 'XRAY', 'UPPER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0114', 'SKULL(SUBMENTOVERTEX, LAT)', 'XRAY', 'HEAD', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0201', 'PARANASAL SINUSES(CALDWELL, WATER\'S)', 'XRAY', 'HEAD', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0202', 'FACIAL BONES 2-3 VIEWS', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0301', 'ORBITS(CALDWELL)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0302', 'ORBITS(SEMI WATER\'S)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0303', 'ORBITS(LAT)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0304', 'ORBITS(CALDWELL, SEMIWATER\'S)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0305', 'ORBITS FOR FOREIGN BODY', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0306', 'OPTIC  FORAMINA(RHESE\'S )', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0401', 'IAC(PA, STENVER\'S, TOWNE\'S)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0501', 'SELLA TURCICA(TOWNE\'S, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0601', 'MASTOID AIR CELLS(LAT, TOWNE\'S)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0602', 'MASTOID AIR CELLS(OBLIQUE)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0701', 'TEMPOROMANDIBULAR JOINT LEFT', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0702', 'T-M JOINT(TOWNE\'S)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0801', 'STYLOID PROCESS(PA, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0901', 'NASAL BONE(WATER\'S)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H0902', 'NASAL BONE(LAT)', 'XRAY', 'HEAD', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H0903', 'NASAL BONE(WATER\'S , LAT)', 'XRAY', 'HEAD', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1001', 'MAXILAR(SEMI-WATER\'S)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1002', 'MAXILAR(PA)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1003', 'MAXILAR(PA, SEMI-WATER\'S)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1101', 'MANDIBLE(PA)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1102', 'MANDIBLE(TOWNE\'S)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1103', 'MANDIBLE(OBLIQUE)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1104', 'MANDIBLE-RT(PA, OBLIQUE)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1105', 'MANDIBLE-LT(PA, OBLIQUE)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1106', 'MANDIBLE(PA, BOTH OBLIQUE, TOWNE\'S)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1201', 'ZYGOMATIC(SUBMENTOVERTEX)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1202', 'ZYGOMATIC(TOWNE\'S)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1203', 'ZYGOMATIC(OBLIQUE TANGENTIAL)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1204', 'ZYGOMATIC(SUBMENTOVERTEX, TOWNE\'S)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1301', 'NASOPHARYNX(LAT, SUBMENTOVERTEX)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1401', 'ADENOID(LAT)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1501', 'NECK(AP)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1502', 'NECK(LAT)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'H1503', 'NECK(AP, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'H1504', 'NECK(LAT SOFT TISSUE)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0101', 'HIP-RT(AP)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0102', 'HIP-LT(AP)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0103', 'HIP-BOTH(AP)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0104', 'HIP (RIGHT) AND PELVIS 3V', 'XRAY', 'HIP', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0105', 'HIP (LEFT) AND PELVIS 3V', 'XRAY', 'HIP', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0106', 'HIPS BILAT 2+ VIEWS', 'XRAY', 'PELVIS', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0107', 'HIP-RT(AP, LAT)', 'XRAY', 'PELVIS', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0108', 'HIP-LT(AP, LAT)', 'XRAY', 'PELVIS', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0109', 'HIPS BILAT W/ PELVIS 3+ VIEWS', 'XRAY', 'PELVIS', 0, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0110', 'HIP-LT(LAT CROSSTABLE)', 'XRAY', 'PELVIS', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0111', 'HIP-RT(AP,LAT CROSSTABLE)', 'XRAY', 'PELVIS', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0205', 'FEMUR-LT(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0206', 'FEMUR-BOTH(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0207', 'FEMUR-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0208', 'FEMUR-LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0209', 'FEMUR INCLUDE KNEE -RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0210', 'FEMUR INCLUDE KNEE -LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0301', 'KNEE-RT(AP)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0302', 'KNEE-LT(AP)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0303', 'KNEE-BOTH(AP)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0304', 'KNEE-BOTH(AP STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0305', 'KNEE-RT(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0306', 'KNEE-LT(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0307', 'KNEE-BOTH(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0308', 'KNEE-RT 3 VIEWS', 'XRAY', 'LOWER', 0, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0309', 'KNEE-LT 3 VIEWS', 'XRAY', 'LOWER', 0, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0310', 'KNEE-BOTH(LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0311', 'KNEE-RT TWO VIEWS', 'XRAY', 'LOWER', 0, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0312', 'KNEE-LT TWO VIEWS', 'XRAY', 'LOWER', 0, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0313', 'KNEE-RT(AP, LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0314', 'KNEE-LT(AP, LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0315', 'KNEE-BOTH(AP, LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0316', 'KNEE-RT(MERCHANT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0317', 'KNEE-LT(MERCHANT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0318', 'KNEE-RT(LAURIN)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0319', 'KNEE-LT(LAURIN)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0320', 'KNEE-RT(HUGHSTON)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0321', 'KNEE-LT(HUGHSTON)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0322', 'KNEE(ORTHROSCANOGRAM)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0323', 'KNEE BOTH(AP STANDING,LAT FLEX 45 )', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0324', 'KNEE BOTH(AP ,LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0325', 'KNEE RT(AP STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0326', 'KNEE LT(AP STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0327', 'KNEE RT(AP,LAT,SKYLINE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0328', 'KNEE LT(AP,LAT,SKYLINE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0329', 'KNEE BOTH(AP,LAT,SKYLINE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0330', 'KNEE-RT(LAT FLEX45)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0331', 'KNEE-LT(LAT FLEX45)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0401', 'PATELLA-RT(SKYLINE OR SUN RISE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0402', 'PATELLA-LT(SKYLINE OR SUN RISE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0403', 'PATELLA-RT(AP, LAT, SKYLINE OR SUN RISE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0611', 'ANKLE-LT( VARUS STRESS)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0612', 'ANKLE-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0613', 'ANKLE-LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0614', 'ANKLE-RT(AP, LAT, MORTISE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0615', 'ANKLE-LT(AP, LAT, MORTISE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0616', 'ANKLE-RT(OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0617', 'ANKLE-LT(OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0618', 'ANKLE-RT(AP,LAT,OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0619', 'ANKLE-LT(AP,LAT,OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0701', 'FOOT-RT(AP)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0702', 'FOOT-LT(AP)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0703', 'FOOT - LEFT 3V', 'XRAY', 'LOWER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0704', 'FOOT-RT(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0705', 'FOOT-LT(LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0706', 'FOOT - RIGHT 3V', 'XRAY', 'LOWER', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'L0707', 'FOOT-RT(OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0708', 'FOOT-LT(OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0709', 'FOOT-BOTH(OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 10, '0', '', 1, 0),
('CENTRAL', 'L0710', 'FOOT-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0711', 'FOOT - LEFT 2V', 'XRAY', 'LOWER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0712', 'FOOT-BOTH(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0713', 'FOOT - RIGHT 2V', 'XRAY', 'LOWER', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0714', 'FOOT-LT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0715', 'FOOT-BOTH(AP,OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 1, 0),
('CENTRAL', 'L0716', 'FOOT-RT-WEIGHT-BEARING(AP, LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0717', 'FOOT-LT-WEIGH-BEARING(AP, LAT STANDING)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0718', 'FOOT-BOTH-WEIGHT-BEARING(AP, LAT STAND)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0801', 'BIG TOE-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0802', 'BIG TOE-RT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0803', 'BIG TOE-LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0804', 'BIG TOE-LT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0901', 'SECOND TOE-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0902', 'SECOND TOE-RT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0903', 'SECOND TOE-LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L0904', 'SECOND TOE-LT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L1001', 'THIRD TOE-RT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L1002', 'THIRD TOE-RT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L1003', 'THIRD TOE-LT(AP, LAT)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'L1004', 'THIRD TOE-LT(AP, OBLIQUE)', 'XRAY', 'LOWER EXTREMITY', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'M0101', 'MRI-BRAIN', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0102', 'MRI-BRAINIAC', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0103', 'MRI-BRAIN+PITUITARY GLAND', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0104', 'MRI-BRAIN NAVIGATOR', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0105', 'MRI-STROKE PACKAGE', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0106', 'MR-PERFUSION BRAIN', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0107', 'MRI-BRAIN+PERFUSION', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0108', 'MRI-FOR EPILEPSY', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0109', 'MRI-FOR DEMENTIA', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0110', 'MRI-BASE OF SKULL', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0111', 'MRI-CAVERNOUS SINUS', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0112', 'MRI-IAC(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0113', 'MRI-CN V', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0114', 'MRI-PITUITARY GLAND', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0115', 'MRI-CSF FLOW (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0116', 'MRI-BRAIN+CSF FLOW', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0117', 'MRI-CISTERNOGRAM (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0118', 'MRI-BRAIN+CISTERNOGRAM', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0119', 'MR SRT or SRS (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0120', 'MR-TRACTOGRAPHY', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0121', 'MRI-BRAIN+ORBITS', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0201', 'MRI-ORBITS.', 'MRI', 'HEAD', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0311', 'MRI-BRACHIAL PLEXUS (NEURO)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0312', 'MRI-SCREENING SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0313', 'MRI-LUMBAR PLEXUS', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0314', 'MRI-SACRAL PLEXUS', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0401', 'MRI-CHEST/THORAX', 'MRI', 'CHEST', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0402', 'MRI-MEDIASTINUM', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0403', 'MRI-BILIARY SYSTEM(MRCP)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0404', 'MRI-UPPER ABDOMEN', 'MRI', 'ABDOMEN', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0405', 'MRI-UPPER ABDOMEN+MRCP', 'MRI', 'ABDOMEN', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0406', 'MRI-LOWER ABDOMEN OR PELVIS', 'MRI', 'PELVIS', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0407', 'MRI-WHOLE ABDOMEN', 'MRI', 'ABDOMEN', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0408', 'MRI-LIVER', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0409', 'MRI-PANCREASE', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0410', 'MRI-ADRENAL GLAND', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0411', 'MRI-KIDNEY', 'MRI', 'ABDOMEN', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0412', 'MRI-PROSTATE GLAND', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0413', 'MRI-PROSTATE GLAND+ENDORECTAL COIL', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0414', 'MRI-PROSTATE CA  EVALATION', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0415', 'MRI-PELVIC CAVITY', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0416', 'MRI-PYELOGRAM', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0501', 'MRI-HEART COMPLETE', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0502', 'MRI-SCREENING CORONARY', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0503', 'MRI-HEART PERFUSION (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0504', 'MRI-Congenital Heart Disease', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0505', 'MRI-HEART (Limited) (Case ASD Screening)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0506', 'MRI-HEART+ Cine', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0601', 'MRI-BREAST UNILATERAL', 'MRI', 'BREAST', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0602', 'MRI-BREAST BILATERAL', 'MRI', 'BREAST', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0603', 'MRI-GUIDE BREAST BIOPSY PROCEDURE', 'MRI', 'BREAST', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0701', 'MRI-CLAVICLE', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0702', 'MR ARTHROGRAPHY', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0703', 'MRI-SHOULDER-RT', 'MRI', 'SHOULDER', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0704', 'MRI-SHOULDER-LT', 'MRI', 'SHOULDER', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0705', 'MRI-HUMERUS-RT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0706', 'MRI-HUMERUS-LT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0707', 'MRI-ELBOW-RT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0708', 'MRI-ELBOW-LT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0709', 'MRI-FOREARM-RT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0710', 'MRI-FOREARM-LT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0711', 'MRI-WRIST-RT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0712', 'MRI-WRIST-LT', 'MRI', 'UPPER EXTREMITY', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0806', 'MRA-THORACIC AORTA (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0807', 'MRA-ABDOMINAL AORTA (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0808', 'MRA-WHOLE AORTA (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0809', 'MRA-ABDOMEN (ONLY)', 'MRI', 'ABDOMEN', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0810', 'MRA-HEPATIC ARTERY(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0811', 'MRA-RENAL ARTERY(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0812', 'MRA-CERVICAL SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0813', 'MRA-CERVICOTHORACIC SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0814', 'MRA-THORACIC SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0815', 'MRA-THORACOLUMBAR SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0816', 'MRA-LUMBOSACRAL SPINE', 'MRI', 'SPINE', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0817', 'MRA-UPPER EXTREMITY-RT(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0818', 'MRA-UPPER EXTREMITY-LT(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0819', 'MRA-LOWER EXTREMITY-RT(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0820', 'MRA-LOWER EXTREMITY-LT(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0821', 'MRA PERIPERAL RUN-OFF(ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M0822', 'MRA-OTHER(SEE NOTE)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1307', 'MR-SPECTROSCOPY-LIVER (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1308', 'MRI+MR-SPECTROSCOPY-LIVER', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1309', 'MR-SPECTROSCOPY-MUSCLE (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1310', 'MR SPECTROSCOPY(ONLY) OTHER', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1401', 'FUNCTIONAL MRI (ONLY)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'M1501', 'MRI-OTHER(SEE NOTE)', 'MRI', '', 20000, 0, 5000, 30, '0', '', 0, 1),
('CENTRAL', 'MM101', 'MAMMOGRAM-RT', 'MAMMO', 'BREAST', 3000, 0, 1000, 20, '1', '', 0, 1),
('CENTRAL', 'MM102', 'MAMMOGRAM-LT', 'MAMMO', 'BREAST', 3000, 0, 1000, 20, '1', '', 0, 1),
('CENTRAL', 'MM103', 'MAMMOGRAM-BOTH', 'MAMMO', 'BREAST', 3000, 0, 1000, 30, '1', '', 0, 1),
('CENTRAL', 'MM104', 'MAMMOGRAM-IMPLANTATION', 'MAMMO', 'BREAST', 3000, 0, 1000, 30, '1', '', 0, 1),
('CENTRAL', 'MM105', 'MAMMOGRAM-SPECIMEN', 'MAMMO', 'BREAST', 3000, 0, 1000, 20, '1', '', 0, 1),
('CENTRAL', 'S0101', 'ODENTOID PROCESS (OPEN MOUTH)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0201', 'C-SPINE(AP)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0202', 'C-SPINE(LAT)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0203', 'C-SPINE(AP, LAT)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0204', 'C-SPINE(AP, LAT, OPEN MOUTH)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0205', 'C-SPINE(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0206', 'C-SPINE FLEXION, EXTENSION', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0207', 'C-SPINE(BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0301', 'C-T-SPINE(AP)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0302', 'C-T-SPINE(LAT)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0303', 'C-T-SPINE(SWIMER\'S)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0304', 'C-T-SPINE(AP, LAT)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0305', 'C-T-SPINE(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0401', 'T-SPINE(AP)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0402', 'TEMPOROMANDIBULAR JOINT BILAT', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0403', 'T-SPINE(AP, LAT)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0404', 'T-SPINE(BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0405', 'T-SPINE(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0406', 'T-SPINE STANDING(AP)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0407', 'T-SPINE STANDING(LAT)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0408', 'T-SPINE STANDING(AP, LAT)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0409', 'T-SPINE STANDING(AP, LAT, BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0410', 'T-SPINE(FLEXION, EXTENSION)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0501', 'T-L SPINE(AP)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0609', 'LUMBAR SPINE 2-3 VIEWS', 'XRAY', 'SPINE', 0, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0610', 'L-S SPINE STANDING(AP,LAT,BOTH OBLIQUE)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0611', 'L-S SPINE STANDING(BENDING)', 'XRAY', 'SPINE', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0612', 'L-S SPINE(FLEXION, EXTENSION)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0613', 'WHOLE SPINE(AP)(SCOLIOTIC)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0614', 'WHOLE SPINE(AP,LAT)(SCOLIOTIC)', 'XRAY', 'SPINE', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0701', 'SACRUM(AP)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0702', 'SACRUM(LAT)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0703', 'SACRUM(AP, LAT)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'S0801', 'S-I JOINT(AP)', 'XRAY', '', 200, 0, 90, 10, '0', '', 0, 1),
('CENTRAL', 'S0802', 'S-I JOINT-RT(AP, OBLIQUE)', 'XRAY', '', 200, 0, 90, 15, '0', '', 0, 1),
('CENTRAL', 'U0114', 'BLADDER', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0115', 'TESTICULAR W/ DOPPLER', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0116', 'PROSTATE W/ BLADDER', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0117', 'PELVIS W/ TRANSVAGINAL', 'US', '', 2000, 0, 50, 30, '0', '', 0, 1),
('CENTRAL', 'U0118', 'PELVIS', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0119', 'ABDOMEN COMPLETE', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0120', 'ABDOMEN - LIMITED', 'US', 'ABDOMEN', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0121', 'KIDNEYS', 'US', 'ABDOMEN', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0122', 'KIDNEYS W/ BLADDER', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0123', 'OBSTETRICAL COMPLETE', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0124', 'OBSTETRICAL - LIMITED', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0125', 'OBSTETRICAL <14 WEEKS', 'US', '', 0, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'U0301', 'UPPER EXTREM SOFT TISSUES', 'US', '', 0, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'U0302', 'LWR EXTREMITY SOFT TISSUES', 'US', '', 0, 0, 1000, 30, '0', '', 0, 1),
('CENTRAL', 'U0401', 'LWR EXTREM VENOUS DOPPLER - RT', 'US', '', 5000, 0, 0, 30, '0', '', 0, 1),
('CENTRAL', 'X0101', 'SIALOGRAM', 'FLUORO', '', 2000, 0, 500, 90, '0', '', 0, 1),
('CENTRAL', 'X0102', 'MYELOGRAM', 'FLUORO', '', 2000, 0, 500, 90, '0', '', 0, 1),
('CENTRAL', 'X0103', 'ERCP', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0104', 'UGI', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0105', 'LONG GI', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0106', 'BARIUM SWALLOW', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0107', 'BARIUM SWALLOW, GI', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0108', 'BE ( DOUBLE AIR CONTRAST)', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0109', 'BE ( SINGLE CONTRAST)', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0110', 'IVP ', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0111', 'RAPID SEQUENCE IVP', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0112', 'VOIDING CYSTOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0113', 'RETROGRADE URETHOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0114', 'RETROGRADE PYELOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0115', 'HYSTEROSALPINGOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0116', 'T-TUBE CHOLANGIOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'X0117', 'FISTULOGRAM', 'FLUORO', '', 2000, 0, 500, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0304', 'PEIT', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0305', 'PCN ', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0306', 'RFA', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0307', 'EMBOLIZATION', 'ANGIO', '', 30000, 0, 10000, 60, '0', '', 0, 1),
('CENTRAL', 'XRTX0308', 'ANGILOPLASTY', 'ANGIO', '', 30000, 0, 10000, 60, '0', '', 0, 1),
('CENTRAL', 'XRTX0602', 'LOCALIZATION BREAST-LT', 'ANGIO', 'BREAST', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0603', 'LOCALIZATION LUNG', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0604', 'LOCALIZATION LIVER', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0605', 'LOCALIZATION KIDNEY-RT', 'ANGIO', 'ABDOMEN', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0606', 'LOCALIZATION KIDNEY-LT', 'ANGIO', 'ABDOMEN', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0607', 'LOCALIZATION  OTHER', 'ANGIO', '', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0701', 'DUCTOGRAM BREAST-RT', 'ANGIO', 'BREAST', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', 'XRTX0702', 'DUCTOGRAM BREAST-LT', 'ANGIO', 'BREAST', 30000, 0, 10000, 30, '0', '', 0, 1),
('CENTRAL', '10046', 'ct  scan', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1040', 'ADDITIONAL MULTIPHASE', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1041', 'ADDITIONAL SUFACE 3D VIEWS', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1019', 'CT LOWER ABDOMEN', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1020', 'CT ORBIT', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1024', 'CT THYROID', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1025', 'CT WHOLE ABDOMEN+NONIONIC CONTRAST', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1026', 'CT WHOLE ABDOMEN ( SCREENING )', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1027', 'CT WHOLE ABDOMEN + CT COLONOSCOPY', 'CT', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '1028', 'CTA BRAIN', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1029', 'CTA CAROTID ARTERY', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1030', 'CTA PULMONARY ARTERY', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1031', 'CTA RENAL ARTERY', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1032', 'CTA THORACIC AORTA', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1033', 'CTA ABDOMINAL AORTA', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1034', 'CTA WHOLE AORTA', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1035', 'CTA FEMORAL ARTERY', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '1036', 'CTA LOWER EXTERMITY', 'CT', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2014', 'MRI T-SPINE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2015', 'MRI L-S SPINE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2017', 'MRI HEART + PERFUSION', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2018', 'MRI HEART+STRESS TEST', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2022', 'MRI LIVER WITH DOUBLE CONTRAST', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2023', 'MRI LOWER ABDOMEN', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2025', 'MRI NECK', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2026', 'MRI ORBIT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2027', 'MRI PARANASAL SINUSES', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2028', 'MRI PITUITARY GLAND', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2029', 'MRI PROSTATE GLAND', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2030', 'MRI PROSTATE SPECIAL COIL', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2031', 'MRCP ', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2032', 'MR SPECTROSCOPY', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2033', 'MRI THYROID', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2034', 'MRI UPPER ABDOMEN', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2036', 'MRI UROGRAPHY', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2037', 'MRI WHOLE ABDOMEN', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '2038', 'MRI WHOLE SPINES', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20087', 'MRI FOOT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20122', 'MRI FUNCIONAL', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20062', 'MRI SHOULDER LT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20069', 'MRI FACE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20079', 'MRI LIVER', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20095', 'MRI  BREAST  RT.', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20097', 'MRI ADRENAL GLAND', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20124', 'MRI MRA (NONBRAIN)', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20125', 'MRI BRAIN + CSF FLOW', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20127', 'MRI BRACHIAL PLEXUS', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20060', 'MRA FEMERAL ARTERY', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20118', 'MRI WRIST LT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20131', 'MRI OROPHARYNX', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20136', 'MRA UPPER /LOWER ABDOMEN', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20148', 'MRI  STERNUM', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20098', 'MRI HIPPOCAMPUS', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20128', 'MRI LS-PLEXUS', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20149', 'MRI CLAVICLE LT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20146', 'MRI  CRANIAL  NERVE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20068', 'MRI MRA MRV NECK', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20071', 'MRI CISTERNOGRAM', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1);
INSERT INTO `xray_code` (`CENTER`, `XRAY_CODE`, `DESCRIPTION`, `XRAY_TYPE_CODE`, `BODY_PART`, `CHARGE_TOTAL`, `PORTABLE_CHARGE`, `DF`, `TIME_USE`, `BIRAD_FLAG`, `PREP_ID`, `DELETE_FLAG`, `ACTIVE`) VALUES
('CENTRAL', '20089', 'MRI CAVERNOUS  SINUS', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20126', 'MRI CRANIAL NERVE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20133', 'MRI THYROID GLANDS', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20144', 'MRA BOTH LEG', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20145', 'MRI  HIP', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20120', 'MRI RT Scapular', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20053', 'MRI KNEE LT', 'MRI', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20055', 'MRI CONTRAST ', 'MRI', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '20057', 'MRI HAND RT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20072', 'MRI ARM  RT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20108', 'MRI ANKLE LT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20110', 'MRA MAXILLA', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20121', 'MRI DIFFUSION /PERFUSION', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20123', 'MRV (ONE PART )', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20052', 'MRI KNEE RT', 'MRI', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20134', 'MRI MEDIASTINUM', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20135', 'MRI HEART CGHD/CINE', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20141', 'MR ARTHROGRAPHY', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '20152', 'MRI ELBOW LT', 'MRI', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '4001', 'LWR EXTREM VENOUS DOPPLER - LT', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '4002', 'CAROTID DOPPLER', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '4003', 'RENAL DOPPLER', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '4005', 'ULTRASOUND KIDNEYS', 'US', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '4004', 'BREAST BILATERAL', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '4016', 'ABDOMINAL AORTA W/ DOPPLER', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '40033', 'LWR EXTREM VENOUS DOPPLER BILAT', 'US', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50139', 'TEMPOROMANDIBULAR JOINT RIGHT', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50140', 'ABDOMEN PRONE (PA)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50141', 'ABDOMEN LT. LATERAL DECUBITUS', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50142', 'ABDOMEN RT. LATERAL DECUBITUS', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50143', '', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50144', 'ABDOMEN RT. LATERAL DORSAL DECUBITUS', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50145', 'ABDOMEN LATERAL SUPINE', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50146', 'ABDOMEN UPRIGHT (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50147', 'ABDOMEN LATERAL UPRIGHT', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50148', 'ANKLE BOTH (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50149', 'ANKLE BOTH (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50150', 'ANKLE BOTH (MORTISE VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50152', 'ANKLE BOTH (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50156', 'ANKLE BOTH (STRESS VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50157', 'ANKLE BOTH (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50158', 'HAND RT. (PA, LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50159', 'ANKLE RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50161', 'ANKLE RT. (MORTISE VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50162', 'ANKLE RT.(STRESS VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50164', 'ANKLE LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50166', 'ANKLE LT. (MORTISE VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50167', 'ANKLE LT. (STRESS VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50168', 'COCCYX (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50169', 'COCCYX (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50183', 'CALCANEUS LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50184', 'CALCANEUS BILAT (AXIAL VIEW)', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50185', 'CALCANEUS BILAT (LATERAL)', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50186', 'CALCANEUS BILAT - 2V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50187', 'CHEST (LT.LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50188', 'CHEST (RT.OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50189', 'CHEST (LT.OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50190', 'CLAVICLE BOTH (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50191', 'AC JOINT RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50192', 'AC JOINT LT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50193', 'AC JOINT BOTH. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50194', 'AC JOINT WITH WEIGHT RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50195', 'AC JOINT WITH WEIGHT LT.(AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50196', 'AC JOINT WITH WEIGHTS BOTH (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50197', 'ELBOW BOTH (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50198', 'ELBOW BOTH (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50199', 'CHEST (AP UPRIGHT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50200', 'ELBOW BOTH (JONES METHOD)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50201', 'ELBOW BOTH (COYLE METHOD)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50202', 'ELBOW RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50203', 'ELBOW RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50204', 'ELBOW RT. (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50206', 'ELBOW RT.(JONES METHOD)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50207', 'ELBOW RT.(COYLE METHOD)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50208', 'ELBOW LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50209', 'ELBOW LT. (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50210', 'FINGER LT. (PA, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50211', 'ELBOW LT. (JONES METHOD)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50212', 'KNEE BILAT 3V EACH', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50213', 'FEMUR BOTH (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50214', 'FEMUR RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50215', 'FEMUR RT. INCLUDE HIP (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50001', 'ABDOMEN SUPINE (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50002', 'ABDOMEN (SUPINE, UPRIGHT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50003', 'ACUTE ABDOMEN SERIES', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50006', 'HAND LT. (PA,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50008', 'TOES - RIGHT 3V', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50011', 'C-SPINES (AP, LAT, BOTH OBLIQUES)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50014', 'BONE AGE', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50016', 'CALCANEUS RT. (AXIAL VIEW, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50018', 'CHEST (PA UPRIGHT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50019', 'CHEST (RT.LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50053', 'HUMERUS RT.(AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50054', 'HUMERUS LT.(AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50056', 'KNEE RIGHT 2V', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50057', 'KNEE LEFT - 2V', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50058', 'KNEE BOTH (AP,LATERAL VIEW)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50064', 'LEG BOTH (AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50066', 'LEG LT. (AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50067', 'LONG BONE', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50069', 'L-S SPINES (BOTH OBL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50071', 'MANDIBLE (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50072', 'MANDIBLE (AP,OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50074', 'NECK (SOFT TISSUE LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50075', 'MASTOID BOTH', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50076', 'MASTOID RT.', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50077', 'MASTIOID LT.', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50078', 'ORBITS - BILATERAL ', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50080', 'ORBIT LT.', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50082', 'PELVIS (INLET VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50085', 'PELVIS (JUDET VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50086', 'PELVIS (RIPSTEIN VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50088', 'SACRUM (AP , LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50089', 'STERNUM (PA , LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50093', 'SHOULDER - BILAT 3V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50097', 'TIBIA FIBULA - RIGHT', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50098', 'TIBIA FIBULA - LEFT', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50099', 'SHOULDER LT. (SUPRASPINATUS OUTLET VIEW )', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50102', 'SHOULDER LT. (STRYKER NOTCH)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50104', 'SHOULDER RT. (AXILLARY VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50105', 'SHOULDER LT. (AXILLARY VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50106', 'SHOULDER BOTH (TRANSCAPULAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50108', 'SHOULDER LT. (TRANSCAPULAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50109', 'SHOULDER BOTH (WEST POINT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50110', 'SHOULDER RT. (WEST POINT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50111', 'SHOULDER LT. (WEST POINT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50221', 'FEMUR LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50222', 'FEMUR LT. INCLUDE HIP (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50223', 'KNEE RIGHT - 3V', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50225', 'K.U.B.', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50226', 'L-S SPINES (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50228', 'ADENOID GLAND', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50233', 'FOOT RT. (OBLIQUE )', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50234', 'FOOT RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50235', 'FEET BILATERAL 3V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50236', 'FEET BILATERAL 2V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50237', 'FEET BOTH (OBLIQUE )', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50240', 'FOOT LT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50242', 'FOOT LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50246', 'ANKLE LT. (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50248', 'CALCANEUS RT. (AXIAL VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50249', 'CALCANEUS RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50250', 'CALCANEUS LT. (AXIAL VIEW, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50251', 'CHEST (AP SUPINE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50252', 'CHEST (SEMI- UPRIGHT)', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50253', 'FEMUR RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50254', 'FEMUR RT. INCLUDE HIP (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50255', 'KNEE LEFT - 3V', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50256', 'FEMUR BOTH INCLUDE HIP (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50257', 'FOOT RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50258', 'FOREARM RT.(AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50259', 'FOREARM RT.(LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50260', 'FOREARM BOTH (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50261', 'FOREARMS BOTH (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50263', 'FOREARM LT.(AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50264', 'FOREARM LT.(LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50266', 'HAND RT. (PA )', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50267', 'HAND RT. (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50269', 'HAND BOTH (PA )', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50270', 'HAND BILAT 2V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50272', 'HAND BILATER 3V EACH', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50273', 'HAND LEFT 3V', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50275', 'HIP RT. (INTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50276', 'HIP RT. (EXTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50277', 'HIP BOTH (LATERAL CROSSTABLE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50278', 'HIP BOTH  (FROG LEG)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50279', 'HIP BOTH  (INTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50280', 'HIP BOTH  (EXTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50282', 'HIP LT. (INTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50283', 'HIP LT. (EXTERNAL ROTATED)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50285', 'KNEE RT. (AP)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50286', 'KNEE RT. ( LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50387', 'ANKLE RT. (AP)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50403', 'RIBS RT. (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50404', 'PELVIS (LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50296', 'KNEE BOTH  (VALGUS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50297', 'KNEE BOTH  (VARUS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50298', 'KNEE BOTH  (ANTERIOR DRAWER STRESS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50299', 'KNEE BOTH  (POSTERIOR DRAWER STRESS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50300', 'KNEE LT. (SKYLINE)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50301', 'KNEE LT. (AP)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50302', 'KNEE LT. ( LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50303', 'KNEE LT. (AP. STANDING , LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50304', 'KNEE LT. (VALGUS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50305', 'KNEE LT. (VARUS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50306', 'KNEE LT. (ANTERIOR DRAWER STRESS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50307', 'KNEE LT. (POSTERIOR DRAWER STRESS)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50308', 'L-S SPINES (BENDING)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50309', 'MANDIBLE (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50310', 'RIBS (AP , OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50375', 'TOE LT. (AP,OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50389', 'PELVIS (OUTLET VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50393', 'ELBOW RT. (RADIOCARPITELLAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50311', 'RIBS (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50312', 'RIBS LT. (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50313', 'S-I JOINT (AP , OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50315', 'SCAPULAR RT. (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50316', 'SCAPULAR RT. (TRANSCAPULAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50317', 'SCAPULAR BOTH (AP, TRANSCAPULAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50350', 'SKULL (SUBMENTOVERTEX)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50354', 'THORACIC SPINE 2 VIEWS', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50355', 'THORACIC SPINES (LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50356', 'THORACIC SPINES (BOTH  OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50357', 'THORACIC SPINES (FLEXION , EXTESION)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50358', 'THORACIC SPINES (BENDING 2 VIEWS)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50359', 'T-L SPINES (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50360', 'T-L SPINES (LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50361', 'T-L SPINES (BENDING 2 VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50362', 'TRAUMA SERIES', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50382', 'HIP RT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50384', 'BABYGRAM', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50396', 'FEMUR RT. INCLUDE HIP (AP, LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50398', 'FEMUR LT. INCLUDE KNEE (AP, LATERAL)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50364', 'WRIST RT. (ULNAR DEVIATION)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50365', 'WRIST RT. (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50366', 'WRIST RT.(CARPAL TUNNEL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50368', 'WRIST BOTH (ULNAR DEVIATION)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50369', 'WRIST BOTH (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50370', 'WRIST BOTH (CARPAL TUNNEL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50372', 'WRIST LT. (ULNAR DEVIATION)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50373', 'WRIST LT. (OBLIQUE)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50374', 'WRIST LT.(CARPAL TUNNEL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50407', 'FOOT RT. (AP,LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50395', 'FEMUR RT. INCLUDE KNEE (AP, LATERAL)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50402', 'KNEE BOTH (AP STANDING)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50406', 'FOOT LT. (AP,LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50408', 'FOOT BOTH (AP,LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50224', 'FEMUR LT. (AP, LATERAL)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50227', 'L-S SPINES (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50238', 'FEET BOTH (LATERAL)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50241', 'FOOT LT. (OBLIQUE )', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50244', 'ANKLE RT. (AP, LATERAL)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50284', 'KNEE RT. (SKYLINE)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '50062', 'KNEE BILATERAL 2V EACH', 'XRAY', 'LOWER', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50065', 'LEG RT. (AP,LAT)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50068', 'L-S SPINES (AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50070', 'L-S SPINES (FLEXION, EXTESION)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50073', 'NASAL BONE ', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50079', 'ORBIT RT.', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50081', 'OPTIC FORAMEN', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50083', 'PELVIS (AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50084', 'PELVIS (INLET,OUTLET)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50090', 'STYLOID PROCESS', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50091', 'SHOULDER - RIGHT 3V', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50092', 'SHOULDER - LEFT 3V', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50103', 'SHOULDER BOTH (AXILLARY VIEW)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50107', 'SHOULDER RT. (TRANSCAPULAR)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50052', 'HUMERUS BOTH (AP,LAT)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50409', 'NECK (SOFT TISSUE AP)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50381', 'HAND LEFT 2V', 'XRAY', '0', 0, 0, 0, 0, '', '', 0, 1),
('CENTRAL', '50383', 'HIP LT. (LATERAL)', 'XRAY', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50400', 'KNEE RT.(NOTCH VIEW)', 'XRAY', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 1, 0),
('CENTRAL', '51001', 'BMD 1 PART', 'BMD', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '51002', 'BMD 2 PART', 'BMD', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '51004', 'BMD(Whole Body)', 'BMD', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52002', 'BARIUM ENEMA,SINGLE CM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52003', 'BARIUM ENEMA,DOUBLE CM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52004', 'BARIUM SWALLOW', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52005', 'CYSTOGRAM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52006', 'ESOPHAGOGRAM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52007', 'Endoscopic Retrograde Cholangio Pancreatography : ', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52008', 'FISTULOGRAPHY', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52009', 'H.S.G.', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52010', 'MYELOGRAM COMPLETE T-SPINES', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52011', 'MYELOGRAM LUMBAR SPINES', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52012', 'RETROGRADE PYELOGRAM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52014', 'SIALOGRAPHY', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52015', 'TRANSHEPATIC CHOLANGGIOGRAPHY', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52016', 'T.TUBE CHOLANGGIOGRAPHY', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52017', 'INTRAOPERATIVE CHOLANGIOGRAPHY', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52018', 'UGI', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52019', 'UGI WITH SMALL BOWEL SERIES', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52020', 'URETHROGRAM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52021', 'V.C.U.G.(42603)', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52022', 'VENOGRAM RT.', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52023', 'VENOGRAM LT.', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52024', 'MYELOGRAM C-SPINE', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52029', 'ANTEGRADE PYELOGRAM', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52026', 'SCANOGRAM BOTH LEGS', 'FLUORO', 'LOWER EXTREMITY', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '52027', 'SCANOGRAM WHOLE SPINES AP', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '53035', 'PERM  CATH.(42514)', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '53013', 'PTBD.(72610)', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '53034', 'Peripherally Inserted Central Catheter : PICC Line', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '53003', 'RT.UPPER EXTREMITY ANGIOGRAM (42513)', 'FLUORO', '0', 0, 0, NULL, NULL, '', '', 0, 1),
('CENTRAL', '50426', 'MANDIBLE (AP,LATERAL)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50427', 'MANDIBLE (LATERAL)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50428', 'SHOULDER RT. (ZANCA VIEW)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50429', 'SHOULDER LT. (ZANCA VIEW)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '51005', 'BMD 3 PART', 'BMD', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50430', 'WRIST LT. (LAT)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '20160', 'MRI LT.FEMUR', 'MR', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50446', 'SKULL PA', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50448', 'THUMB BOTH (PA,LATERAL)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50451', 'HUMERUS BOTH (AP)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50450', 'THUMB LT. (PA,LATERAL)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50449', 'THUMB RT. (PA,LATERAL)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50434', 'MANDIBLE (LT.OBLIQUE)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50441', 'LEG BOTH (LAT)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50436', 'MANDIBLE (AP, RT.OBLIQUE)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50444', 'LEG RT. (AP)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '53055', 'Fluoroscopic Observation', 'FLUORO', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50443', 'LEG LT. (LAT)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '50453', 'SHOULDER RT.(Velpeau View)', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 0, 1),
('CENTRAL', '5024', '', 'XRAY', '', 0, 0, NULL, NULL, '0', '', 1, 0),
('CENTRAL', '1011', 'CT PLAIN K.U.B.', 'CT', '', 0, 0, NULL, NULL, '0', '', 1, 0),
('CENTRAL', 'xx', 'uiuiui', '', '', 0, 0, 0, 15, '0', '1', 1, 0),
('CENTRAL', 'test', 'test0909', 'ANGIO', 'ABDOMEN', 6666, 66, 66, 15, '0', '1', 1, 0),
('CENTRAL', 'tesdfsdft', 'test', 'ANGIO', 'ABDOMEN', 6666, 66, 66, 15, '0', '1', 1, 0),
('CENTRAL', 'testxxx', 'test0909', 'ANGIO', 'ABDOMEN', 6666, 66, 66, 15, '0', '1', 1, 0),
('CENTRAL', 'xxx', 'uiuiui', '', '', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-001', 'Chest PA view', 'XRAY', 'CHEST', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-002', 'Chest AP View', 'XRAY', 'CHEST', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-003', 'Abdomen AP View', 'XRAY', 'ABDOMEN', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-004', 'Abdomen AP, Semierect and LLD view', 'XRAY', 'ABDOMEN', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-005', 'Hand AP and Lateral View', 'XRAY', 'UPPER', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-006', 'Whole Abdomen Ultrasound', 'US', 'ABDOMEN', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-007', 'Intravenous pyelography (IVP)', 'XRAY', 'ABDOMEN', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-008', 'Head CT Scan', 'CT', 'HEAD', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-009', 'Chest CT Scan', 'CT', 'CHEST', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'RSUD1-010', 'Abdominal CT Scan', 'CT', 'ABDOMEN', 0, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', 'T001', 'test X ray', 'XRAY', 'CHEST', 100, 0, 0, 15, '0', '', 1, 0),
('CENTRAL', '122233312', 'TOES - LEFT 3V', 'XRAY', 'FEET', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'CAP1V', 'CHEST AP - ONE VIEW', 'XRAY', 'CHEST', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'usthyr1', 'THYROID', 'US', 'NECK', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USBRUNILAT', 'BREAST LEFT', 'US', 'OTHER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USBREASTLT', 'BREAST RIGHT', 'US', 'OTHER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USNECK1', 'NECK', 'US', 'NECK', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USHIPBIL', 'HIP BILATERAL', 'US', 'LOWER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USHIPLEFT', 'HIP LEFT', 'US', 'LOWER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USHIPRIGHT', 'HIP RIGHT', 'US', 'LOWER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USUPPEREXTREM', 'UPPER EXTREM VENOUS DOPPLER - BILAT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USBACK', 'BACK OR PARASPINAL SOFT TISSUES', 'US', 'OTHER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USINGUINALL', 'INGUINAL LEFT', 'US', 'PELVIS', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USINGUINALR', 'INGUINAL RIGHT', 'US', 'PELVIS', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USINGUINALB', 'INGUINAL BILAT', 'US', 'PELVIS', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USABDWALL', 'ABDOMINAL WALL', 'US', 'ABDOMEN', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'XRPARANASAL', 'PARANASAL SINUSES 3V', 'XRAY', 'HEAD', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USAXILLART', 'AXILLA - RIGHT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USAXILLALT', 'AXILLA- LEFT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USAXILLABILAT', 'AXILLA - BILAT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USUPPERVENR', 'UPPER EXTREM VENOUS DOPPLER - RT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USUPPERVENL', 'UPPER EXTREM VENOUS DOPPLER - LT', 'US', 'UPPER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'USENDOVEN', 'ENDOVENOUS OCCLUSION DUPLEX ASSESSMENT', 'US', 'LOWER', 0, 0, 0, 15, '0', '', 0, 1),
('CENTRAL', 'xxxxxxx', 'xxxxxxx', 'XRAY', 'ABDOMEN', 0, 0, 0, 15, '0', '', 0, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_configs`
--

CREATE TABLE `xray_configs` (
  `ID` int(3) NOT NULL,
  `CENTER` text DEFAULT NULL,
  `LOG_TIME` int(3) NOT NULL DEFAULT 90,
  `PACS_URL` text DEFAULT NULL,
  `PACS_PARAM1` text DEFAULT NULL,
  `PACS_PARAM2` text DEFAULT NULL,
  `TOPBAR_CREATEXAM` int(1) NOT NULL DEFAULT 1,
  `TOPBAR_SCHEDULER` int(1) NOT NULL DEFAULT 1,
  `TOPBAR_EXAMLIST` int(1) NOT NULL DEFAULT 1,
  `TOPBAR_EXAMROOM` int(1) NOT NULL DEFAULT 1,
  `TOPBAR_REASSIGN` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_configs`
--

INSERT INTO `xray_configs` (`ID`, `CENTER`, `LOG_TIME`, `PACS_URL`, `PACS_PARAM1`, `PACS_PARAM2`, `TOPBAR_CREATEXAM`, `TOPBAR_SCHEDULER`, `TOPBAR_EXAMLIST`, `TOPBAR_EXAMROOM`, `TOPBAR_REASSIGN`) VALUES
(1, 'CENTRAL', 30, 'http://127.0.0.1:3000/viewer', '', '/', 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_country`
--

CREATE TABLE `xray_country` (
  `COUNTRY_CODE` varchar(20) NOT NULL,
  `COUNTRY_NAME` varchar(50) NOT NULL,
  `COUNTRY_NAME_ENG` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_department`
--

CREATE TABLE `xray_department` (
  `CENTER` varchar(10) NOT NULL,
  `DEPARTMENT_ID` varchar(20) NOT NULL,
  `NAME_THAI` varchar(50) NOT NULL,
  `NAME_ENG` varchar(50) NOT NULL,
  `TYPE` varchar(1) NOT NULL,
  `DELETE_FLAG` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_department`
--

INSERT INTO `xray_department` (`CENTER`, `DEPARTMENT_ID`, `NAME_THAI`, `NAME_ENG`, `TYPE`, `DELETE_FLAG`) VALUES
('CENTRAL', '1670944632', 'OPD', 'OPD', 'O', 0),
('CENTRAL', '1692170352', 'icu', 'icu', 'O', 0),
('CENTRAL', '1706700004', 'dam', 'dam', 'O', 0),
('CENTRAL', '1707315863', '2132DEP', '2132DEP', 'O', 0),
('CENTRAL', '1709823570', 'ssss', 'ssss', 'O', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_digi_form_mammo`
--

CREATE TABLE `xray_digi_form_mammo` (
  `ID` int(10) NOT NULL,
  `ACCESSION` int(30) NOT NULL,
  `EVER` varchar(1) NOT NULL,
  `FAMILY_MOM` varchar(1) NOT NULL,
  `FAMILY_SIS` varchar(1) NOT NULL,
  `FAMILY__AUN` varchar(1) NOT NULL,
  `FAMILY_GRAN_MOM` varchar(1) NOT NULL,
  `FAMILY_DAUG` varchar(1) NOT NULL,
  `FAMILY_COU` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_film_folder`
--

CREATE TABLE `xray_film_folder` (
  `ID` tinyint(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_icd`
--

CREATE TABLE `xray_icd` (
  `CODE` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_image_status`
--

CREATE TABLE `xray_image_status` (
  `HN` varchar(10) NOT NULL,
  `XN` varchar(10) NOT NULL,
  `DEPARTMENT_ID` varchar(10) NOT NULL,
  `MOVE_BY` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `TYPE_STATUS` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_labresult`
--

CREATE TABLE `xray_labresult` (
  `ID` int(10) NOT NULL,
  `PATIENT_ID` varchar(10) DEFAULT NULL,
  `LAB_CODE` varchar(10) DEFAULT NULL,
  `LAB_DESCRIPTION` varchar(50) DEFAULT NULL,
  `LAB_DATE` varchar(10) DEFAULT NULL,
  `LAB_TIME` varchar(10) DEFAULT NULL,
  `LAB_RESULT` varchar(50) DEFAULT NULL,
  `LAB_UNIT` varchar(10) DEFAULT NULL,
  `LAB_NOTE` varchar(50) DEFAULT NULL,
  `LAB_USER_REC` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_labresult`
--

INSERT INTO `xray_labresult` (`ID`, `PATIENT_ID`, `LAB_CODE`, `LAB_DESCRIPTION`, `LAB_DATE`, `LAB_TIME`, `LAB_RESULT`, `LAB_UNIT`, `LAB_NOTE`, `LAB_USER_REC`) VALUES
(1, '4', '', 'Creatinine', '2023-02-01', '13:24', '68', '', '', '2'),
(2, '1', '', 'Cretinine', '2023-02-01', '13:25', '50', '', '', '2'),
(3, '4', '', 'Creatinine', '', '', '58', '', 'afeadca', '1'),
(4, '4', '', '435345435435', '2023-02-01', '', 'test', '', 'test', '1');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_log`
--

CREATE TABLE `xray_log` (
  `ID` int(11) NOT NULL,
  `USER` varchar(20) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `IP` varchar(30) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `EVENT` varchar(20) NOT NULL,
  `MRN` varchar(20) DEFAULT NULL,
  `ACCESSION` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_log`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_modalities`
--

CREATE TABLE `xray_modalities` (
  `ID` int(11) NOT NULL,
  `MOD_NAME` varchar(20) NOT NULL,
  `MOD_TYPE` varchar(20) DEFAULT NULL,
  `MOD_DESCRIPTION` varchar(50) DEFAULT NULL,
  `AE_TITLE` varchar(50) DEFAULT NULL,
  `IP_ADDRESS` varchar(50) DEFAULT NULL,
  `PORT` varchar(20) DEFAULT NULL,
  `MOD_DEFAULT` int(1) NOT NULL DEFAULT 0,
  `MOD_DELETE` int(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_modalities`
--

INSERT INTO `xray_modalities` (`ID`, `MOD_NAME`, `MOD_TYPE`, `MOD_DESCRIPTION`, `AE_TITLE`, `IP_ADDRESS`, `PORT`, `MOD_DEFAULT`, `MOD_DELETE`) VALUES
(1, 'SCANNER', 'CT', 'SCANNER', 'HRI_CTAWP96969', '192.168.100.4', '104', 1, 1),
(2, 'ECHO ACCUSON 1000', 'US', 'ECHO ACCUSON 1000', 'US2003', '192.168.100.13', '104', 1, 0),
(3, 'ARTIS138502', 'AX', 'ARTIS138502', 'ARTIS138502', '192.168.100.40', '104', 1, 1),
(4, 'MRI', 'MRI', 'USTRASOUND ROOM4', 'AN_MEDCOMNT204', '192.168.100.5', '104', 1, 0),
(5, 'RADIO', 'XP', 'RADIO', 'FLC_WK_SCU', '192.168.100.7', '104', 1, 0),
(6, 'ECHOJUNEPER', 'US', 'ACUSONJUNIPER', 'ACUSONJUNIPER', '192.168.100.17', '104', 0, 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_modalities_type`
--

CREATE TABLE `xray_modalities_type` (
  `ID` int(2) NOT NULL,
  `MOD_TYPE` varchar(20) NOT NULL,
  `MOD_DESCRIPTION` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_modalities_type`
--

INSERT INTO `xray_modalities_type` (`ID`, `MOD_TYPE`, `MOD_DESCRIPTION`) VALUES
(1, 'CT', 'CT'),
(2, 'MR', 'MRI'),
(3, 'CR', 'CR'),
(4, 'DR', 'DR'),
(5, 'US', 'US'),
(6, 'MG', 'MAMMO'),
(7, 'XA', 'XA');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_mwl`
--

CREATE TABLE `xray_mwl` (
  `IP` varchar(20) NOT NULL,
  `AE` varchar(50) NOT NULL,
  `PORT` int(5) NOT NULL,
  `MOD_TYPE` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_name_prefix`
--

CREATE TABLE `xray_name_prefix` (
  `ID` varchar(5) NOT NULL,
  `THAI` varchar(50) NOT NULL,
  `ENG` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_news`
--

CREATE TABLE `xray_news` (
  `ID` int(11) NOT NULL,
  `CENTER_CODE` varchar(20) NOT NULL,
  `NEWS` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_news`
--

INSERT INTO `xray_news` (`ID`, `CENTER_CODE`, `NEWS`) VALUES
(1, 'CENTRAL', '   Welcome to ThaiRIS testing\r\n\r\n         TEST New<div><br></div><div>Welcome to ThaiRIS Free 1.8</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_note`
--

CREATE TABLE `xray_note` (
  `ID` int(2) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_order_cart`
--

CREATE TABLE `xray_order_cart` (
  `ID` int(10) NOT NULL,
  `SESSION_ID` varchar(50) NOT NULL,
  `MRN` varchar(15) NOT NULL,
  `XRAY_CODE` varchar(30) NOT NULL,
  `DATE` date NOT NULL,
  `REFERRER_ID` varchar(10) DEFAULT NULL,
  `USER_ID` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_patient_info`
--

CREATE TABLE `xray_patient_info` (
  `ID` int(10) NOT NULL,
  `CENTER_CODE` varchar(10) NOT NULL,
  `MRN` varchar(15) NOT NULL,
  `XN` varchar(15) DEFAULT NULL,
  `SSN` varchar(13) DEFAULT NULL,
  `PREFIX` varchar(50) DEFAULT NULL,
  `NAME` varchar(120) NOT NULL,
  `LASTNAME` varchar(120) NOT NULL,
  `NAME_ENG` varchar(120) DEFAULT NULL,
  `LASTNAME_ENG` varchar(120) DEFAULT NULL,
  `MIDDLE_NAME` varchar(150) DEFAULT NULL,
  `NAME_OLD` varchar(50) DEFAULT NULL,
  `LASTNAME_OLD` varchar(50) DEFAULT NULL,
  `SEX` varchar(10) DEFAULT NULL,
  `BIRTH_DATE` date DEFAULT NULL,
  `HEIGHT` varchar(6) DEFAULT NULL,
  `WEIGHT` varchar(6) DEFAULT NULL,
  `TELEPHONE` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `NOTE` varchar(2000) DEFAULT NULL,
  `CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `FIRSTVISITDATE` date DEFAULT NULL,
  `LASTVISITDATE` date DEFAULT NULL,
  `RIGHT_CODE` varchar(10) DEFAULT NULL,
  `ADDRESS` varchar(500) DEFAULT NULL,
  `VILLAGE` varchar(50) DEFAULT NULL,
  `ROAD` varchar(50) DEFAULT NULL,
  `TAMBON_CODE` varchar(50) DEFAULT NULL,
  `AMPHOE_CODE` varchar(50) DEFAULT NULL,
  `PROVINCE_CODE` varchar(20) DEFAULT NULL,
  `COUNTRY_CODE` varchar(50) DEFAULT NULL,
  `PAYMENT` varchar(30) DEFAULT NULL,
  `CREATININE` text DEFAULT NULL,
  `LABDATE` varchar(10) DEFAULT NULL,
  `LAST_MENSTRUAL` varchar(10) DEFAULT NULL,
  `BIRTH` varchar(2) DEFAULT NULL,
  `GESTATION` varchar(2) DEFAULT NULL,
  `ABORTION` varchar(2) DEFAULT NULL,
  `CESAREAN` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- dump ตาราง `xray_patient_info`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_patient_info_addition`
--

CREATE TABLE `xray_patient_info_addition` (
  `ID` int(10) NOT NULL,
  `MRN` varchar(15) NOT NULL,
  `BIRTH` varchar(2) DEFAULT NULL,
  `CESAREAN` varchar(2) DEFAULT NULL,
  `ABORTION` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_patient_rel`
--

CREATE TABLE `xray_patient_rel` (
  `ID` int(11) NOT NULL,
  `CENTER_CODE` varchar(20) NOT NULL,
  `MRN` varchar(15) NOT NULL,
  `REL1_TYPE` varchar(20) DEFAULT NULL,
  `REL1_NAME` varchar(20) DEFAULT NULL,
  `REL1_ADDRESS` varchar(50) DEFAULT NULL,
  `REL1_CITY` varchar(20) DEFAULT NULL,
  `REL1_ZIP` varchar(20) DEFAULT NULL,
  `REL1_STAGE` varchar(20) DEFAULT NULL,
  `REL1_PHONE` varchar(20) DEFAULT NULL,
  `REL1_EMAIL` varchar(20) DEFAULT NULL,
  `REL2_TYPE` varchar(20) DEFAULT NULL,
  `REL2_NAME` varchar(20) DEFAULT NULL,
  `REL2_ADDRESS` varchar(50) DEFAULT NULL,
  `REL2_CITY` varchar(20) DEFAULT NULL,
  `REL2_ZIP` varchar(20) DEFAULT NULL,
  `REL2_STAGE` varchar(20) DEFAULT NULL,
  `REL2_PHONE` varchar(20) DEFAULT NULL,
  `REL2_EMAIL` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_patient_rel`
--



-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_patient_right`
--

CREATE TABLE `xray_patient_right` (
  `RIGHT_CODE` varchar(10) NOT NULL,
  `RIGHT_NAME` varchar(50) NOT NULL,
  `DISCOUNT` int(3) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_preparation`
--

CREATE TABLE `xray_preparation` (
  `PREP_ID` int(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `MODALITY` varchar(20) DEFAULT NULL,
  `BODY_PART` varchar(20) DEFAULT NULL,
  `DESCRIPTION_THAI` varchar(5000) DEFAULT NULL,
  `DESCRIPTION_ENG` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_preparation`
--

INSERT INTO `xray_preparation` (`PREP_ID`, `NAME`, `MODALITY`, `BODY_PART`, `DESCRIPTION_THAI`, `DESCRIPTION_ENG`) VALUES
(1, 'test', 'CT', 'tes', '	teset	', '	test	'),
(2, 'test2', 'CT', 'test2', 'test2', 'test2'),
(3, 'test2', 'FLUORO', 'test2', 'test2', 'test2'),
(4, 'test', 'ANGIO', 'ABDOMEN', 'tes', 'test'),
(5, 'CT Upper Abdomen', 'CT', 'ABDOMEN', '	<u>		การเตรียมตัวตรวจช่องท้อง		</u><div><div>1. งดน้ำอาหารอย่างน้อย 4-6 ชั่วโมง</div><div>2. รับประทานยาได้ตามปกติ ยกเว้น ผู้ป่วยเบาหวานให้งดยาเบาหวานในวันตรวจ</div><div>3. เจ้าหน้าที่ทำการซักประวัติการแพ้สารทึบรังสี แพ้อาหารทะเล เป็นโรคภูมิแพ้ เป็นโรคหอบหืดรุนแรง โรคหัวใจ โรคเกี่ยวกับไต ก่อนการตรวจ</div><div>4. โดยทั่วไป แพทย์จะให้ทานน้ำผสมสารทึบรังสี ประมาณ 1,000 cc. ก่อนการตรวจ 1-2 ชั่วโมง และอาจต้องสวนน้ำผสมสารทึบรังสี เข้าทางทวารหนัก</div><div>5. พยาบาลจะให้สารน้ำผ่านทางหลอดเลือดบริเวณข้อพับแขน เพื่อให้สำหรับการฉีดสารทึบรังสี ในระหว่างการตรวจ ผู้ป่วย</div></div>	', '<p style=\"margin: 1em 0px; padding: 0px; font-family: \'Helvetica Neue\', arial, geneva, helvetica, sans-serif; font-size: 13px; background-color: rgb(255, 255, 204);\"><b style=\"margin: 0px; padding: 0px;\">Preparation</b>&nbsp;<br style=\"margin: 0px; padding: 0px;\">Adult patients should not eat 4 hours prior to the appointment time, but may drink clear liquids up until 2 hours prior to the appointment time (unless otherwise instructed).&nbsp; Any medication that is needed should be taken as prescribed with a small amount of water, unless otherwise instructed by the Radiology Department.&nbsp;</p><p style=\"margin: 1em 0px; padding: 0px; font-family: \'Helvetica Neue\', arial, geneva, helvetica, sans-serif; font-size: 13px; background-color: rgb(255, 255, 204);\">Clear Liquids Allowed:</p><ul style=\"margin: 1em 0px; padding: 0px 0px 0px 2em; font-family: \'Helvetica Neue\', arial, geneva, helvetica, sans-serif; font-size: 13px; background-color: rgb(255, 255, 204);\"><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Tea/black coffee</li><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Apple or cranberry juice</li><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Lemon or Lime Jello-O</li><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Clear Chicken or Beef Broth</li><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Clear Sodas (7-UP, Sprite, Ginger Ale)</li><li style=\"margin: 0px; padding: 0px; list-style: circle url(http://www.med.umich.edu/ott/images/core/bullet.gif);\">Water</li></ul><p style=\"margin: 1em 0px; padding: 0px; font-family: \'Helvetica Neue\', arial, geneva, helvetica, sans-serif; font-size: 13px; background-color: rgb(255, 255, 204);\">If you have any known allergies to dye or iodine, the CT Department or Radiologist needs to be aware of the allergy and what type of reaction you have had. This information will allow the radiologist to arrange for pre-medication for you through your referring physician or make necessary arrangements. Please call the Radiology Department at (734) 936-4500 if you have any known contrast allergies.</p>'),
(6, 'TEST001', 'CT', 'ABDOMEN', '	<b><font size=\"5\">test2</font></b><div><b><font size=\"5\"><u>Pakorn Homhuandee</u></font></b></div>	', '	<b><font size=\"5\">test</font></b><div><b><font size=\"5\"><u>Pakorn Homhuandee</u></font></b></div>	'),
(7, 'Upper Abdomen (Female)', 'US', 'ABDOMEN', '		ภาษาไทย การเตรียมตัว สำหรับ 5555<div><br></div>', '		English prep form for Ultrasound 3333	');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_printer`
--

CREATE TABLE `xray_printer` (
  `LOCATION` varchar(20) NOT NULL,
  `IP` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_province`
--

CREATE TABLE `xray_province` (
  `PROVINCE_CODE` varchar(20) NOT NULL,
  `PROVINCE_NAME` varchar(50) NOT NULL,
  `PROVINCE_NAME_ENG` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_radiologist_assign`
--

CREATE TABLE `xray_radiologist_assign` (
  `ID` int(10) NOT NULL,
  `DEFAULT_RAD_ID` int(3) NOT NULL,
  `DEFAULT_GROUP_ID` int(11) NOT NULL,
  `TYPE_ASSIGN` int(11) NOT NULL,
  `AUTO_ASSIGN_ENABLE` int(1) NOT NULL DEFAULT 1,
  `GROUP_ASSIGN_ENABLE` int(1) NOT NULL DEFAULT 1,
  `LAST_ASSIGN_RAD_ID` int(5) DEFAULT NULL,
  `AUTO_ASSIGN_PAGE` int(11) DEFAULT NULL,
  `STEP_AUTO_ASSIGN` int(11) DEFAULT NULL,
  `LIST` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_radiologist_assign`
--

INSERT INTO `xray_radiologist_assign` (`ID`, `DEFAULT_RAD_ID`, `DEFAULT_GROUP_ID`, `TYPE_ASSIGN`, `AUTO_ASSIGN_ENABLE`, `GROUP_ASSIGN_ENABLE`, `LAST_ASSIGN_RAD_ID`, `AUTO_ASSIGN_PAGE`, `STEP_AUTO_ASSIGN`, `LIST`) VALUES
(1, 0, 1, 0, 1, 1, NULL, 1, 3, '0)Manual, 1)Default, 2)Modaity, 3)Group Page:1)Regist2)Arrive3)EndexamPage:1)Reg');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_radiologist_group`
--

CREATE TABLE `xray_radiologist_group` (
  `GROUP_ID` int(5) NOT NULL,
  `GROUP_NAME` varchar(50) NOT NULL,
  `GROUP_MEMBER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_radiologist_group_modality`
--

CREATE TABLE `xray_radiologist_group_modality` (
  `GROUP_ID` int(5) NOT NULL,
  `GROUP_NAME` varchar(50) NOT NULL,
  `GROUP_MEMBER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_radiologist_group_modality`
--

INSERT INTO `xray_radiologist_group_modality` (`GROUP_ID`, `GROUP_NAME`, `GROUP_MEMBER`) VALUES
(1, 'CT', ''),
(2, 'MRI', 'xxx'),
(3, 'MAMMO', 'XRAY'),
(4, 'US', ''),
(5, 'XRAY', ''),
(6, 'FLUORO', ''),
(7, 'BMD', '');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_referrer`
--

CREATE TABLE `xray_referrer` (
  `ID` int(11) NOT NULL,
  `REFERRER_ID` varchar(20) DEFAULT NULL,
  `DEGREE` varchar(10) NOT NULL DEFAULT 'MD',
  `NAME` varchar(50) DEFAULT NULL,
  `LASTNAME` varchar(50) DEFAULT NULL,
  `NAME_ENG` varchar(50) DEFAULT NULL,
  `LASTNAME_ENG` varchar(50) DEFAULT NULL,
  `PREFIX` varchar(3) DEFAULT NULL,
  `SEX` varchar(5) DEFAULT NULL,
  `CENTER_CODE` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `FAX` varchar(50) DEFAULT NULL,
  `DELETE_FLAG` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_referrer`
--

INSERT INTO `xray_referrer` (`ID`, `REFERRER_ID`, `DEGREE`, `NAME`, `LASTNAME`, `NAME_ENG`, `LASTNAME_ENG`, `PREFIX`, `SEX`, `CENTER_CODE`, `EMAIL`, `FAX`, `DELETE_FLAG`) VALUES
(1, '001', 'MD', 'fffff', 'sadjasldjas', NULL, NULL, '', '', 'CENTRAL', '', '', 1),
(2, '1692171139', '', 'ASAS', 'SASA', NULL, NULL, NULL, NULL, 'CENTRAL', '', '', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_report`
--

CREATE TABLE `xray_report` (
  `ID` int(20) NOT NULL,
  `ACCESSION` varchar(30) DEFAULT NULL,
  `REPORT` text DEFAULT NULL,
  `BIRAD` varchar(1) DEFAULT NULL,
  `HISTORY` text DEFAULT NULL,
  `CALCIUM` varchar(5000) DEFAULT NULL,
  `CORONARY` varchar(5000) DEFAULT NULL,
  `KEY_IMAGE_LINK` varchar(5000) DEFAULT NULL,
  `DICTATE_BY` varchar(10) DEFAULT NULL,
  `DICTATE_DATE` date DEFAULT NULL,
  `DICTATE_TIME` time DEFAULT NULL,
  `APPROVE_BY` varchar(10) DEFAULT NULL,
  `APPROVE_DATE` date DEFAULT NULL,
  `APPROVE_TIME` time DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `CENTER_CODE` varchar(20) DEFAULT NULL,
  `REFERRER_ID` varchar(10) DEFAULT NULL,
  `PDF_REPORT` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_report`
--

INSERT INTO `xray_report` (`ID`, `ACCESSION`, `REPORT`, `BIRAD`, `HISTORY`, `CALCIUM`, `CORONARY`, `KEY_IMAGE_LINK`, `DICTATE_BY`, `DICTATE_DATE`, `DICTATE_TIME`, `APPROVE_BY`, `APPROVE_DATE`, `APPROVE_TIME`, `STATUS`, `CENTER_CODE`, `REFERRER_ID`, `PDF_REPORT`) VALUES
(31, 'X67-25-20125', 'test test<div id=\"REPORTAREA\">\r\n		</div>\r\n	', '', NULL, NULL, NULL, NULL, '2', '2024-06-16', '20:57:57', '2', '2024-06-16', '20:57:57', NULL, 'CENTRAL', '1692171139', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_report_structure`
--

CREATE TABLE `xray_report_structure` (
  `ID` int(10) NOT NULL,
  `MODALITY_TYPE` varchar(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `GROUP` varchar(20) NOT NULL,
  `DETAIL` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_report_structure`
--

INSERT INTO `xray_report_structure` (`ID`, `MODALITY_TYPE`, `NAME`, `TYPE`, `GROUP`, `DETAIL`) VALUES
(1, 'CT', 'CALCIUM-SCORE', 'text_html', '', '<b>A coronary artery calcium scoring examination was performed on a multi-slice computed tomography scanner (Brilliance 64, Philips Medical Systems). The data was used to detect and quantify the presence of calcified plaque in the coronary arteries.</b> <table width=\"100%\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">   <tr>     <td colspan=\"4\">Key scan parameters : </td>   </tr>   <tr>     <td width=\"15%\" align=\"right\">kVp:</td>     <td width=\"20%\">&nbsp;</td>     <td width=\"45%\" align=\"right\">Slice Thickness(mm):</td>     <td width=\"20%\">&nbsp;</td>   </tr>   <tr>     <td width=\"15%\" align=\"right\">mAs:</td>     <td width=\"20%\">&nbsp;</td>     <td width=\"45%\" align=\"right\">Rotation Time (s):</td>     <td width=\"20%\">&nbsp;</td>   </tr>   <tr>     <td width=\"15%\" align=\"right\">Gating:</td>     <td width=\"20%\">&nbsp;</td>     <td width=\"45%\" align=\"right\">&nbsp;</td>     <td width=\"20%\">&nbsp;</td>   </tr> </table>'),
(2, 'CT', 'CORONARY-SCORING', 'text_html', '', '<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">   <tr>     <td colspan=\"2\"><em>The patient has a total Calcium Score of:</em></td>     <td width=\"32%\" rowspan=\"5\"><img src=image/bkk/bkk-heart.jpg /></td>   </tr>   <tr>     <td width=\"23%\" align=\"right\"><em>Protocol Name:</em></td>     <td width=\"45%\" align=\"left\">&nbsp;</td>   </tr>   <tr>     <td align=\"right\"><em>Weighting:</em></td>     <td align=\"left\">&nbsp;</td>   </tr>   <tr>     <td align=\"right\"><em>Threshold:</em></td>     <td align=\"left\">&nbsp;</td>   </tr>   <tr>     <td align=\"right\"><em>Density Mode:</em></td>     <td align=\"left\">&nbsp;</td>   </tr> </table><br />'),
(3, 'CT', 'Chest pain', 'checkbox', 'risk', ''),
(4, 'CT', 'Dyspnea', 'checkbox', 'risk', ''),
(5, 'CT', 'Palpitation', 'checkbox', 'risk', ''),
(6, 'CT', 'Smoking', 'checkbox', 'risk', ''),
(7, 'CT', 'Abnormal ECG', 'checkbox', 'risk', ''),
(8, 'CT', 'Abnormal wall motion', 'checkbox', 'risk', ''),
(9, 'CT', 'Positive EST', 'checkbox', 'risk', ''),
(10, 'CT', 'Family history of CA', 'checkbox', 'risk', ''),
(11, 'CT', 'Hypertension', 'checkbox', 'risk', ''),
(12, 'CT', 'Diabetes Mellitus', 'checkbox', 'risk', ''),
(13, 'CT', 'Hypercholesterolemia', 'checkbox', 'risk', ''),
(14, 'CT', 'Peripheral arterial disease', 'checkbox', 'risk', ''),
(15, 'CT', 'Previous stroke', 'checkbox', 'risk', ''),
(16, 'CT', 'Previous MI', 'checkbox', 'risk', ''),
(17, 'CT', 'Previous CABG', 'checkbox', 'risk', ''),
(18, 'CT', 'Previous PCI', 'checkbox', 'risk', '');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_report_template`
--

CREATE TABLE `xray_report_template` (
  `ID` int(5) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `XRAY_CODE` varchar(50) NOT NULL,
  `XRAY_TYPE_CODE` varchar(10) NOT NULL,
  `BODY_PART` varchar(15) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `REPORT_DETAIL` varchar(10000) NOT NULL,
  `ALL_USER` varchar(1) NOT NULL DEFAULT '0',
  `TIME_CREATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CENTER_CODE` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_report_template`
--

INSERT INTO `xray_report_template` (`ID`, `NAME`, `XRAY_CODE`, `XRAY_TYPE_CODE`, `BODY_PART`, `USER_ID`, `REPORT_DETAIL`, `ALL_USER`, `TIME_CREATE`, `CENTER_CODE`) VALUES
(1, 'TEST', '', 'US', 'ABDOMEN', '2', '<span style=\"text-align: center;\">A radiology report harmonization intervention to reduce radiology report template variation was successfully implemented at a large academic health care system. Report harmonization resulted in the elimination of 97.0% of attending radiologist templates, including all personal templates, and the creation of systemwide standardized templates for all imaging studies. Although there was variability in the percentage decrease in report templates between divisions and work groups, all sub-specialty divisions had a large decrease in number of unique report templates. There was a sustained and high level of adherence to the harmonized report templates during the study period of up to 9 months after implementation. Multifaceted interventions, including early involvement of stakeholders, a well-designed structure, a process to resolve potential conflicts, careful implementation to avoid disruptions in workflow, leadership engagement, and continuous monitoring, were the keys to successful implementation of this quality improvement project.</span><br style=\"text-align: center;\"><span style=\"color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; background-color: rgb(204, 204, 204); text-align: center;\"><br><br><br></span>', '0', '2023-02-20 01:16:18', NULL),
(2, 'TEST2', '', 'US', 'ABDOMEN', '2', '<div class=\"NLM_sec\" style=\"\"><span class=\"title2\" id=\"d539571e596\" style=\"font-weight: bold; text-decoration-line: underline;\">Maintenance</span><p id=\"P24\" class=\"last\" style=\"\">To prevent divergence from the harmonized templates after implementation, radiologists are no longer allowed (by departmental policy) to create personal templates or modify harmonized templates. All templates are available only at the enterprise level, and all personal templates are monitored and removed from personal accounts via intermittent (at least quarterly) audits. Personal macros, however, are allowed to maintain individual stylistic preferences and to aid efficiency in reporting.</p></div><div class=\"NLM_sec\" style=\"\"><span class=\"title2\" id=\"d539571e605\" style=\"font-weight: bold; text-decoration-line: underline;\">Outcome Measures</span><p id=\"P25\" class=\"last\">The primary outcome measure was percentage reduction in templates by work group after harmonization was complete. The secondary outcome measure was adherence to harmonized templates for 8 months after harmonization implementation. This was done by manually reviewing 40 random reports per month for eight consecutive months after going live, allowing a 1 month wash-in period (months 2â€“9 after actual implementation date until the month of this writing). This sample size yielded a confidence level of 80% and margin of error of 10% for proportion of reports completed with harmonized templates. Any deviation from the proposed harmonized templates, including change in main headings or subheadings, was considered nonadherence to harmonized templates.</p></div><span style=\"color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; background-color: rgb(204, 204, 204); text-align: center;\"><br></span>', '0', '2023-02-20 01:17:14', NULL),
(3, 'TestTemple', 'B0706', 'XRAY', 'OTHER', '7', 'xx<div style=\"font-weight: normal; font-style: normal;\"><span style=\"font-weight: bold; text-decoration-line: underline;\"><br></span></div><div style=\"font-weight: normal; font-style: normal;\"><span style=\"font-weight: bold; text-decoration-line: underline;\">TESTING TEST</span></div><div style=\"font-weight: normal; font-style: normal;\"><br></div><div style=\"\"><span style=\"font-style: italic; font-weight: bold;\">The RI</span><span style=\"font-style: italic; font-weight: 700; font-size: 12pt;\">S</span></div>', '1', '2024-02-14 11:39:48', NULL),
(4, 'testTem122', 'B0207', 'XRAY', 'LOWER EXTREMITY', '7', '<span style=\"text-align: center;\">A radiology report harmonization intervention to reduce radiology report template variation was successfully implemented at a large academic health care system. Report harmonization resulted in the elimination of 97.0% of attending radiologist templates, including all personal templates, and the creation of systemwide standardized templates for all imaging studies. Although there was variability in the percentage decrease in report templates between divisions and work groups, all sub-specialty divisions had a large decrease in number of unique report templates. There was a sustained and high level of adherence to the harmonized report templates during the study period of up to 9 months after implementation. Multifaceted interventions, including early involvement of stakeholders, a well-designed structure, a process to resolve potential conflicts, careful implementation to avoid disruptions in workflow, leadership engagement, and continuous monitoring, were the keys to successful implementation of this quality improvement project.</span><br style=\"text-align: center;\"><span style=\"color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; background-color: rgb(204, 204, 204); text-align: center;\"><br><br><br></span>', '0', '2024-02-19 12:52:42', NULL),
(5, 'save', 'C0204', 'CT', 'CHEST', '7', '<span style=\"text-align: center;\">A radiology report harmonization intervention to reduce radiology report template variation was successfully implemented at a large academic health care system. Report harmonization resulted in the elimination of 97.0% of attending radiologist templates, including all personal templates, and the creation of systemwide standardized templates for all imaging studies. Although there was variability in the percentage decrease in report templates between divisions and work groups, all sub-specialty divisions had a large decrease in number of unique report templates. There was a sustained and high level of adherence to the harmonized report templates during the study period of up to 9 months after implementation. Multifaceted interventions, including early involvement of stakeholders, a well-designed structure, a process to resolve potential conflicts, careful implementation to avoid disruptions in workflow, leadership engagement, and continuous monitoring, were the keys to successful implementation of this quality improvement project.</span><br style=\"text-align: center;\"><span style=\"color: rgb(102, 102, 102); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; background-color: rgb(204, 204, 204); text-align: center;\"><br><br><br></span>', '0', '2024-02-19 12:54:32', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_request`
--

CREATE TABLE `xray_request` (
  `ID` int(11) NOT NULL,
  `REQUEST_NO` varchar(30) NOT NULL,
  `XN` varchar(15) DEFAULT NULL,
  `MRN` varchar(15) NOT NULL,
  `REFERRER` varchar(20) DEFAULT NULL,
  `REQUEST_DATE` date DEFAULT NULL,
  `REQUEST_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp(),
  `DEPARTMENT_ID` varchar(20) DEFAULT NULL,
  `PORTABLE` int(1) UNSIGNED DEFAULT NULL,
  `USER` varchar(10) DEFAULT NULL,
  `CANCEL_STATUS` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `USER_ID_CANCLE` varchar(10) DEFAULT NULL,
  `CANCEL_DATE` date DEFAULT NULL,
  `CANCEL_TIME` time DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT '1',
  `ICON` varchar(50) DEFAULT NULL,
  `NOTE` varchar(500) DEFAULT NULL,
  `CENTER_CODE` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_request`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_request_detail`
--

CREATE TABLE `xray_request_detail` (
  `ID` int(10) NOT NULL,
  `REQUEST_NO` varchar(30) NOT NULL,
  `ACCESSION` varchar(30) NOT NULL,
  `CASE_NO` varchar(30) DEFAULT NULL,
  `XRAY_CODE` varchar(30) NOT NULL,
  `CHARGED` int(1) DEFAULT NULL,
  `REQUEST_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp(),
  `REQUEST_TIME` time NOT NULL DEFAULT '00:00:00',
  `REQUEST_DATE` date DEFAULT NULL,
  `SCHEDULE_DATE` date DEFAULT NULL,
  `SCHEDULE_TIME` time DEFAULT NULL,
  `REPORT_TIME` time DEFAULT NULL,
  `REPORT_DATE` date DEFAULT NULL,
  `PRELIM_ID` varchar(10) DEFAULT NULL,
  `PRELIM_TIME` datetime DEFAULT NULL,
  `REPORT_STATUS` varchar(1) DEFAULT '0',
  `CANCEL_STATUS` varchar(1) DEFAULT '0',
  `USER_ID_CANCEL` varchar(10) DEFAULT NULL,
  `ARRIVAL_TIME` timestamp NULL DEFAULT NULL,
  `READY_TIME` timestamp NULL DEFAULT NULL,
  `START_TIME` timestamp NULL DEFAULT NULL,
  `COMPLETE_TIME` timestamp NULL DEFAULT NULL,
  `ASSIGN_TIME` timestamp NULL DEFAULT NULL,
  `APPROVED_TIME` timestamp NULL DEFAULT NULL,
  `ASSIGN_ID` varchar(20) DEFAULT NULL,
  `ASSING_GROUP_ID` varchar(20) DEFAULT NULL,
  `ASSIGN_CODE` varchar(20) DEFAULT NULL,
  `ASSIGN_BY` varchar(20) DEFAULT NULL,
  `TRANS_BY` varchar(10) DEFAULT NULL,
  `TRANS_TIME` datetime DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'NEW',
  `STATUS_REPORT` varchar(20) NOT NULL DEFAULT 'UNREAD',
  `PAGE` varchar(15) NOT NULL DEFAULT 'ORDER LIST',
  `LOCKBY` varchar(15) DEFAULT NULL,
  `URGENT` varchar(1) NOT NULL DEFAULT '0',
  `LASTREPORT_ID` varchar(20) DEFAULT NULL,
  `TEMP_REPORT` varchar(15000) DEFAULT NULL,
  `AUTO_SAVE_TIME` timestamp NULL DEFAULT current_timestamp(),
  `TECH1` varchar(5) DEFAULT NULL,
  `TECH2` varchar(5) DEFAULT NULL,
  `TECH3` varchar(5) DEFAULT NULL,
  `FLAG1` varchar(1) DEFAULT NULL,
  `FLAG2` varchar(1) DEFAULT NULL,
  `FLAG3` varchar(1) DEFAULT NULL,
  `REPORT_BOOK` varchar(30) DEFAULT NULL,
  `STUDY_UID` varchar(150) DEFAULT NULL,
  `NOTE` varchar(150) DEFAULT NULL,
  `HL7` int(1) NOT NULL DEFAULT 0,
  `DF` decimal(10,0) DEFAULT NULL,
  `CHARGED_PRICE` decimal(10,0) DEFAULT NULL,
  `RECEIPT_NO` varchar(20) DEFAULT NULL,
  `PAID` varchar(1) DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_request_detail`
--
-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_room`
--

CREATE TABLE `xray_room` (
  `ID` int(11) NOT NULL,
  `CENTER` varchar(10) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(20) NOT NULL,
  `TYPE` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_room`
--

INSERT INTO `xray_room` (`ID`, `CENTER`, `NAME`, `DESCRIPTION`, `TYPE`) VALUES
(0, 'CENTRAL', 'US1', 'Ultrasound Room1', 'US'),
(0, 'CENTRAL', 'US2', 'Ultrasound Room2', 'US'),
(0, 'CENTRAL', 'CT', 'CT ROOM', 'CT'),
(0, 'CENTRAL', 'GEN1', 'General Xray Room1', 'XRAY'),
(0, 'CENTRAL', 'GEN2', 'General Xray Room2', 'XRAY'),
(0, 'CENTRAL', 'PORT1', 'Portable', 'XRAY'),
(0, 'CENTRAL', 'FLU1', 'Flu Room1', 'SPECIAL');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_schedule`
--

CREATE TABLE `xray_schedule` (
  `HN` varchar(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `AGE` varchar(3) NOT NULL,
  `WARD` varchar(20) NOT NULL,
  `DATE` date NOT NULL,
  `TIME_START` time NOT NULL,
  `TIME_END` time NOT NULL,
  `DATE_REG` date NOT NULL,
  `ROOM` varchar(20) NOT NULL,
  `XRAY_CODE` varchar(10) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `DOCTOR_ID_REQUEST` varchar(10) DEFAULT NULL,
  `REASON_FOR_STUDY` varchar(2000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_sc_calendar`
--

CREATE TABLE `xray_sc_calendar` (
  `calendar_id` int(11) NOT NULL,
  `calendar_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_sc_calendar`
--

INSERT INTO `xray_sc_calendar` (`calendar_id`, `calendar_name`) VALUES
(1, 'CT'),
(2, 'MRI');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_sc_events`
--

CREATE TABLE `xray_sc_events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(20) DEFAULT NULL,
  `event_description` varchar(20) DEFAULT NULL,
  `calendar_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `all_day` smallint(6) DEFAULT 0,
  `repeat_mode` varchar(11) DEFAULT NULL,
  `repeat_count` int(11) DEFAULT NULL,
  `day_only_weekdays` int(11) DEFAULT NULL,
  `week_days` varchar(20) DEFAULT NULL COMMENT 'comma number of days',
  `month_weeknumber` int(11) DEFAULT NULL,
  `month_weekday` int(11) DEFAULT NULL,
  `month_repeatdate` datetime DEFAULT NULL,
  `event_type` varchar(20) DEFAULT NULL,
  `rel_event_id` int(11) DEFAULT NULL,
  `repeat_end_date` datetime DEFAULT NULL,
  `event_delete_ind` int(11) DEFAULT NULL,
  `recur_sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_status`
--

CREATE TABLE `xray_status` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(10) NOT NULL,
  `NAME` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_status`
--

INSERT INTO `xray_status` (`ID`, `CODE`, `NAME`) VALUES
(1, 'NEW', 'NEW'),
(2, 'ARRIVAL', 'ARRIVAL'),
(3, 'SCHEDULE', 'SCHEDULE'),
(4, 'WAIT', 'WAIT'),
(5, 'ENDEXAM', 'ENDEXAM'),
(6, 'ASSIGN', 'ASSIGN'),
(7, 'COMPLETE', 'COMPLETE'),
(8, 'STARTEXAM', 'STARTEXAM'),
(9, 'CANCEL', 'CANCEL');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_stock`
--

CREATE TABLE `xray_stock` (
  `ID` int(6) NOT NULL,
  `STOCK_CODE` varchar(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `AMOUNT` int(3) UNSIGNED NOT NULL,
  `PRICE` int(7) NOT NULL,
  `UNIT` varchar(20) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_stock_type`
--

CREATE TABLE `xray_stock_type` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_stock_type`
--

INSERT INTO `xray_stock_type` (`ID`, `NAME`) VALUES
(1, 'CONTRAST'),
(2, 'FILM'),
(3, 'MEDICINES'),
(4, 'MISCELLANEOUS');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_tambon`
--

CREATE TABLE `xray_tambon` (
  `TAMBON_CODE` varchar(20) NOT NULL,
  `TAMBON_NAME` varchar(50) NOT NULL,
  `TAMBON_NAME_ENG` varchar(50) NOT NULL,
  `AMPHOE_CODE` varchar(20) NOT NULL,
  `POST_CODE` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_teaching_cases`
--

CREATE TABLE `xray_teaching_cases` (
  `ID` int(11) NOT NULL,
  `SECTION_ID` varchar(20) NOT NULL,
  `MRN` varchar(10) NOT NULL,
  `ACCESSION` varchar(16) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `USER_GROUP` varchar(10) NOT NULL,
  `USER_ALL` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_teaching_cat`
--

CREATE TABLE `xray_teaching_cat` (
  `ID` int(5) NOT NULL,
  `SECTION` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_teaching_cat`
--

INSERT INTO `xray_teaching_cat` (`ID`, `SECTION`) VALUES
(1, 'Abdominal Imaging'),
(2, 'Breast Imaging'),
(3, 'Cardiovascular'),
(4, 'Chest Imaging'),
(5, 'Genital (Female) Imaging'),
(6, 'Head & Neck Imaging'),
(7, 'Interventional Radio'),
(8, 'Musculoskeletal System'),
(9, 'Neuroradiology'),
(10, 'Paediatric Radiology'),
(11, 'Uroradiology & Genital Male Imaging');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_type`
--

CREATE TABLE `xray_type` (
  `XRAY_TYPE_CODE` varchar(10) NOT NULL,
  `TYPE_NAME` varchar(50) NOT NULL,
  `TYPE_NAME_ENG` varchar(50) DEFAULT NULL,
  `MOD_TYPE` varchar(20) DEFAULT NULL,
  `ACTIVE` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_type`
--

INSERT INTO `xray_type` (`XRAY_TYPE_CODE`, `TYPE_NAME`, `TYPE_NAME_ENG`, `MOD_TYPE`, `ACTIVE`) VALUES
('ANGIO', 'Angio', 'Angiography', 'ANGIO\r', 1),
('BMD', 'Bone Mineral Densitometry', 'Bone Mineral Densitometry', 'BMD', 1),
('CT', 'Computed Tomography', 'Computed Tomography', 'CT', 1),
('FLUORO', 'FLUORO', 'FLUORO', 'FLUORO', 1),
('MAMMO', 'Mammography', 'Mammography', 'MG', 1),
('MRI', 'Magnetic Resonance Imaging', 'Magnetic Resonance Imaging', 'MRI', 1),
('US', 'Ultrasound', 'Ultrasound', 'US', 1),
('XRAY', 'General Xray(CR/DR)', 'General Xray(CR/DR)', 'XRAY', 1),
('DR', 'DR', 'DR', 'DR', 0),
('CR', 'CR', 'CR', 'CR', 0),
('DEXA', 'DEXA', 'DEXA', 'DEXA', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_usage`
--

CREATE TABLE `xray_usage` (
  `ID` int(10) NOT NULL,
  `REQUEST_NO` varchar(10) NOT NULL,
  `ACCESSION` varchar(10) NOT NULL,
  `FILM_SIZE` varchar(10) NOT NULL,
  `FILM_QULITY` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user`
--

CREATE TABLE `xray_user` (
  `ID` int(5) NOT NULL,
  `CODE` varchar(15) DEFAULT NULL,
  `DF_CODE` varchar(15) DEFAULT NULL,
  `LOGIN` varchar(20) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `NAME_ENG` varchar(50) DEFAULT NULL,
  `LASTNAME_ENG` varchar(50) DEFAULT NULL,
  `USER_TYPE_CODE` varchar(20) NOT NULL,
  `PREFIX` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `CENTER_CODE` varchar(10) NOT NULL,
  `CREATED_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `SESSION` varchar(100) DEFAULT NULL,
  `ENABLE` varchar(1) NOT NULL DEFAULT '1',
  `ALL_CENTER` tinyint(1) NOT NULL DEFAULT 0,
  `LOGINTIME` time DEFAULT NULL,
  `TEXT_SIGNATURE` varchar(200) DEFAULT NULL,
  `PACS_LOGIN` varchar(20) DEFAULT NULL,
  `DICTAGE_PASSWORD` int(1) NOT NULL DEFAULT 0,
  `LANDING_PAGE` varchar(30) DEFAULT NULL,
  `SIGNATURE_IMAGE` int(1) NOT NULL DEFAULT 0,
  `SIGNATURE_TEXT` int(1) NOT NULL DEFAULT 0,
  `google_secret_code` varchar(50) DEFAULT NULL,
  `LANGUAGE` varchar(20) NOT NULL DEFAULT 'english',
  `EMAIL` varchar(100) DEFAULT NULL,
  `TEMP` varchar(15000) DEFAULT NULL,
  `LAST_ACTION_TIME` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_user`
--

INSERT INTO `xray_user` (`ID`, `CODE`, `DF_CODE`, `LOGIN`, `NAME`, `LASTNAME`, `NAME_ENG`, `LASTNAME_ENG`, `USER_TYPE_CODE`, `PREFIX`, `PASSWORD`, `CENTER_CODE`, `CREATED_TIME`, `SESSION`, `ENABLE`, `ALL_CENTER`, `LOGINTIME`, `TEXT_SIGNATURE`, `PACS_LOGIN`, `DICTAGE_PASSWORD`, `LANDING_PAGE`, `SIGNATURE_IMAGE`, `SIGNATURE_TEXT`, `google_secret_code`, `LANGUAGE`, `EMAIL`, `TEMP`, `LAST_ACTION_TIME`) VALUES
(1, 'Default1', 'Default1', 'admin', 'Administrator', 'admin', 'TESTEnglishNAME', 'TESTEnglishLastname', 'ADMIN', 'BR', 'd54e5ae10222d681124b795096598b65', 'CENTRAL', '2009-08-26 19:10:45', '7ulsk4br5gda0pgnv629ovdr4r', '1', 0, '22:45:33', 'test test test test test&nbsp;', 'pacs1', 0, NULL, 0, 0, NULL, 'english', NULL, '', '2024-06-15 02:57:57'),
(2, '1670944449', '', 'rad', 'Radiologist', 'Rad1', '', '', 'RADIOLOGIST', 'MD', 'a72e45c24510a6889800a3e6d9d698e8', 'CENTRAL', '2022-12-13 15:15:36', 'crnt56ar0eak0ccehbs0gj76ra', '1', 0, '17:32:27', NULL, '', 0, NULL, 0, 0, NULL, 'english', NULL, '', '2024-06-08 09:02:39'),
(3, '1670944696', '', 'tech', 'tech', 'tech', '', '', 'TECHNICIAN', '', '0276edb105e7453866bbce5472d9a111', 'CENTRAL', '2022-12-13 15:18:40', NULL, '1', 0, NULL, NULL, '', 0, NULL, 0, 0, NULL, 'english', NULL, NULL, NULL),

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_df_code`
--

CREATE TABLE `xray_user_df_code` (
  `ID` int(11) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `DF_CODE` varchar(20) NOT NULL,
  `NAME_THAI` varchar(50) NOT NULL,
  `NAME_ENG` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_right`
--

CREATE TABLE `xray_user_right` (
  `USER_ID` int(3) NOT NULL,
  `SUPER_ADMIN` int(1) NOT NULL DEFAULT 0,
  `ADMIN` int(1) NOT NULL DEFAULT 0,
  `ADMIN_CENTER` int(1) NOT NULL DEFAULT 0,
  `DELETE_ORDER` int(1) NOT NULL DEFAULT 0,
  `CHANGE_STATUS` int(1) NOT NULL DEFAULT 0,
  `EDIT_PATIENT` int(1) NOT NULL DEFAULT 0,
  `UPLOAD` int(1) NOT NULL DEFAULT 1,
  `DEL_UPLOAD` int(1) NOT NULL DEFAULT 1,
  `UPDATE_CODE` int(1) NOT NULL DEFAULT 1,
  `CREATE_ORDER` int(1) NOT NULL DEFAULT 1,
  `RESET_USER_PASSWORD` int(1) NOT NULL DEFAULT 1,
  `SEE_ALL_WORKLIST` int(1) NOT NULL DEFAULT 0,
  `ASSIGN_RAD` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_user_right`
--

INSERT INTO `xray_user_right` (`USER_ID`, `SUPER_ADMIN`, `ADMIN`, `ADMIN_CENTER`, `DELETE_ORDER`, `CHANGE_STATUS`, `EDIT_PATIENT`, `UPLOAD`, `DEL_UPLOAD`, `UPDATE_CODE`, `CREATE_ORDER`, `RESET_USER_PASSWORD`, `SEE_ALL_WORKLIST`, `ASSIGN_RAD`) VALUES
(1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 1),


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_type`
--

CREATE TABLE `xray_user_type` (
  `CODE` int(10) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `NAME` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_user_type`
--

INSERT INTO `xray_user_type` (`CODE`, `TYPE`, `NAME`) VALUES
(1, 'ADMIN', 'ADMIN'),
(4, 'RADIOLOGIST', 'RADIOLOGIST'),
(3, 'CLINICIAN', 'CLINICIAN'),
(2, 'CLERK', 'CLERK'),
(5, 'TECHNICIAN', 'TECHNICIAN'),
(6, 'VIEWER', 'VIEWER'),
(7, 'TRANSCRIPTIONIST', 'TRANSCRIPTIONIST');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_worklist_dictate`
--

CREATE TABLE `xray_user_worklist_dictate` (
  `ID` int(10) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `SEARCHBOX` int(1) DEFAULT NULL,
  `SEARCHDATE` varchar(20) DEFAULT NULL,
  `DATE001` varchar(20) DEFAULT NULL,
  `DATE002` varchar(20) DEFAULT NULL,
  `TODAY` varchar(20) DEFAULT NULL,
  `TODAYTYPE` varchar(20) DEFAULT NULL,
  `SEARCHHN` varchar(20) DEFAULT NULL,
  `SEARCHACC` varchar(20) DEFAULT NULL,
  `SEARCHNAME` varchar(20) DEFAULT NULL,
  `SEARCHLAST` varchar(20) DEFAULT NULL,
  `DEPARTMENT` varchar(20) DEFAULT NULL,
  `MOD_OPTION1` varchar(20) DEFAULT NULL,
  `MOD_OPTION2` varchar(20) DEFAULT NULL,
  `MOD_OPTION3` varchar(20) DEFAULT NULL,
  `MOD_OPTION4` varchar(20) DEFAULT NULL,
  `MOD_OPTION5` varchar(20) DEFAULT NULL,
  `MOD_OPTION6` varchar(20) DEFAULT NULL,
  `MOD_OPTION7` varchar(20) DEFAULT NULL,
  `MOD_OPTION8` varchar(20) DEFAULT NULL,
  `MOD_OPTION9` varchar(20) DEFAULT NULL,
  `STATUS_RP1` varchar(20) DEFAULT NULL,
  `STATUS_RP2` varchar(20) DEFAULT NULL,
  `STATUS_RP3` varchar(20) DEFAULT NULL,
  `STATUS_RP4` varchar(20) DEFAULT NULL,
  `DATE_LOG` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_user_worklist_dictate`
--

INSERT INTO `xray_user_worklist_dictate` (`ID`, `USER_ID`, `SEARCHBOX`, `SEARCHDATE`, `DATE001`, `DATE002`, `TODAY`, `TODAYTYPE`, `SEARCHHN`, `SEARCHACC`, `SEARCHNAME`, `SEARCHLAST`, `DEPARTMENT`, `MOD_OPTION1`, `MOD_OPTION2`, `MOD_OPTION3`, `MOD_OPTION4`, `MOD_OPTION5`, `MOD_OPTION6`, `MOD_OPTION7`, `MOD_OPTION8`, `MOD_OPTION9`, `STATUS_RP1`, `STATUS_RP2`, `STATUS_RP3`, `STATUS_RP4`, `DATE_LOG`) VALUES
(26, '4', 1, '', '2022-01-01', '2022-10-15', '', '', '', '', '', '', '', '', '', '', '', 'US', 'ANGIO', 'BMD', 'FLUORO', '', 'UNREAD', 'TRANS', 'PRELIM', NULL, '2022-10-15'),
(47, '2', 1, '', '2021-08-04', '2024-06-08', '', '', '', '', '', '', '', 'CT', 'MRI', 'XRAY', 'MAMMO', 'US', 'ANGIO', 'BMD', 'FLUORO', '', 'UNREAD', 'TRANS', 'PRELIM', NULL, '2024-06-08');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_worklist_examroom`
--

CREATE TABLE `xray_user_worklist_examroom` (
  `ID` int(10) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `SEARCHBOX` int(1) DEFAULT NULL,
  `SEARCHDATE` varchar(20) DEFAULT NULL,
  `DATE001` varchar(20) DEFAULT NULL,
  `DATE002` varchar(20) DEFAULT NULL,
  `TODAY` varchar(20) DEFAULT NULL,
  `TODAYTYPE` varchar(20) DEFAULT NULL,
  `SEARCHHN` varchar(20) DEFAULT NULL,
  `SEARCHXN` varchar(20) DEFAULT NULL,
  `SEARCHNAME` varchar(20) DEFAULT NULL,
  `SEARCHLAST` varchar(20) DEFAULT NULL,
  `DEPARTMENT` varchar(20) DEFAULT NULL,
  `MOD_OPTION1` varchar(20) DEFAULT NULL,
  `MOD_OPTION2` varchar(20) DEFAULT NULL,
  `MOD_OPTION3` varchar(20) DEFAULT NULL,
  `MOD_OPTION4` varchar(20) DEFAULT NULL,
  `MOD_OPTION5` varchar(20) DEFAULT NULL,
  `MOD_OPTION6` varchar(20) DEFAULT NULL,
  `MOD_OPTION7` varchar(20) DEFAULT NULL,
  `MOD_OPTION8` varchar(20) DEFAULT NULL,
  `MOD_OPTION9` varchar(20) DEFAULT NULL,
  `STATUS_RP1` varchar(20) DEFAULT NULL,
  `STATUS_RP2` varchar(20) DEFAULT NULL,
  `STATUS_RP3` varchar(20) DEFAULT NULL,
  `STATUS_RP4` varchar(20) DEFAULT NULL,
  `STATUS_START` varchar(20) DEFAULT NULL,
  `STATUS_END` varchar(20) DEFAULT NULL,
  `STATUS_QC` varchar(20) DEFAULT NULL,
  `ARRIVAL1` varchar(20) DEFAULT NULL,
  `ARRIVAL2` varchar(20) DEFAULT NULL,
  `DATE_LOG` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_user_worklist_examroom`
--

INSERT INTO `xray_user_worklist_examroom` (`ID`, `USER_ID`, `SEARCHBOX`, `SEARCHDATE`, `DATE001`, `DATE002`, `TODAY`, `TODAYTYPE`, `SEARCHHN`, `SEARCHXN`, `SEARCHNAME`, `SEARCHLAST`, `DEPARTMENT`, `MOD_OPTION1`, `MOD_OPTION2`, `MOD_OPTION3`, `MOD_OPTION4`, `MOD_OPTION5`, `MOD_OPTION6`, `MOD_OPTION7`, `MOD_OPTION8`, `MOD_OPTION9`, `STATUS_RP1`, `STATUS_RP2`, `STATUS_RP3`, `STATUS_RP4`, `STATUS_START`, `STATUS_END`, `STATUS_QC`, `ARRIVAL1`, `ARRIVAL2`, `DATE_LOG`) VALUES
(36, '4', 1, '', '2022-10-05', '2022-10-15', '', '', '', '', '', '', '', 'CT', 'MRI', 'XRAY', 'MAMMO', 'US', 'ANGIO', '', '', '', 'UNREAD', 'PRELIM', 'TRANS', '', '', '', '', '2022-10-15 00:00:00', '2022-10-15 23:59:59', '2022-10-15');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_user_worklist_order`
--

CREATE TABLE `xray_user_worklist_order` (
  `ID` int(10) NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `SEARCHBOX` int(1) DEFAULT NULL,
  `SEARCHDATE` varchar(20) DEFAULT NULL,
  `DATE001` varchar(20) DEFAULT NULL,
  `DATE002` varchar(20) DEFAULT NULL,
  `TODAY` varchar(20) DEFAULT NULL,
  `TODAYTYPE` varchar(20) DEFAULT NULL,
  `SEARCHHN` varchar(20) DEFAULT NULL,
  `SEARCHXN` varchar(20) DEFAULT NULL,
  `SEARCHNAME` varchar(20) DEFAULT NULL,
  `SEARCHLAST` varchar(20) DEFAULT NULL,
  `DEPARTMENT` varchar(20) DEFAULT NULL,
  `MOD_OPTION1` varchar(20) DEFAULT NULL,
  `MOD_OPTION2` varchar(20) DEFAULT NULL,
  `MOD_OPTION3` varchar(20) DEFAULT NULL,
  `MOD_OPTION4` varchar(20) DEFAULT NULL,
  `MOD_OPTION5` varchar(20) DEFAULT NULL,
  `MOD_OPTION6` varchar(20) DEFAULT NULL,
  `MOD_OPTION7` varchar(20) DEFAULT NULL,
  `MOD_OPTION8` varchar(20) DEFAULT NULL,
  `MOD_OPTION9` varchar(20) DEFAULT NULL,
  `DATE_LOG` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `xray_version`
--

CREATE TABLE `xray_version` (
  `VERSION` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- dump ตาราง `xray_version`
--

INSERT INTO `xray_version` (`VERSION`) VALUES
('1.0'),
('');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xray_api_client`
--
ALTER TABLE `xray_api_client`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_auto`
--
ALTER TABLE `xray_auto`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_billing`
--
ALTER TABLE `xray_billing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_birad`
--
ALTER TABLE `xray_birad`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_body_part`
--
ALTER TABLE `xray_body_part`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `xray_center`
--
ALTER TABLE `xray_center`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODE` (`CODE`);

--
-- Indexes for table `xray_code`
--
ALTER TABLE `xray_code`
  ADD PRIMARY KEY (`XRAY_CODE`,`CENTER`) USING BTREE;

--
-- Indexes for table `xray_configs`
--
ALTER TABLE `xray_configs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_country`
--
ALTER TABLE `xray_country`
  ADD PRIMARY KEY (`COUNTRY_CODE`);

--
-- Indexes for table `xray_department`
--
ALTER TABLE `xray_department`
  ADD PRIMARY KEY (`DEPARTMENT_ID`);

--
-- Indexes for table `xray_film_folder`
--
ALTER TABLE `xray_film_folder`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_image_status`
--
ALTER TABLE `xray_image_status`
  ADD PRIMARY KEY (`HN`);

--
-- Indexes for table `xray_labresult`
--
ALTER TABLE `xray_labresult`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_log`
--
ALTER TABLE `xray_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_modalities`
--
ALTER TABLE `xray_modalities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_modalities_type`
--
ALTER TABLE `xray_modalities_type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `xray_news`
--
ALTER TABLE `xray_news`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_order_cart`
--
ALTER TABLE `xray_order_cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_patient_info`
--
ALTER TABLE `xray_patient_info`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MRN` (`MRN`);

--
-- Indexes for table `xray_patient_info_addition`
--
ALTER TABLE `xray_patient_info_addition`
  ADD PRIMARY KEY (`MRN`);

--
-- Indexes for table `xray_patient_rel`
--
ALTER TABLE `xray_patient_rel`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_patient_right`
--
ALTER TABLE `xray_patient_right`
  ADD PRIMARY KEY (`RIGHT_CODE`);

--
-- Indexes for table `xray_preparation`
--
ALTER TABLE `xray_preparation`
  ADD PRIMARY KEY (`PREP_ID`);

--
-- Indexes for table `xray_province`
--
ALTER TABLE `xray_province`
  ADD PRIMARY KEY (`PROVINCE_CODE`);

--
-- Indexes for table `xray_radiologist_assign`
--
ALTER TABLE `xray_radiologist_assign`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_radiologist_group`
--
ALTER TABLE `xray_radiologist_group`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indexes for table `xray_radiologist_group_modality`
--
ALTER TABLE `xray_radiologist_group_modality`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indexes for table `xray_referrer`
--
ALTER TABLE `xray_referrer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `REFERRER_ID` (`REFERRER_ID`);

--
-- Indexes for table `xray_report`
--
ALTER TABLE `xray_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_report_structure`
--
ALTER TABLE `xray_report_structure`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_report_template`
--
ALTER TABLE `xray_report_template`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_request`
--
ALTER TABLE `xray_request`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `REQUEST_NO` (`REQUEST_NO`);

--
-- Indexes for table `xray_request_detail`
--
ALTER TABLE `xray_request_detail`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ACCESSION` (`ACCESSION`),
  ADD KEY `ACCESSION_2` (`ACCESSION`),
  ADD KEY `ACCESSION_3` (`ACCESSION`);

--
-- Indexes for table `xray_schedule`
--
ALTER TABLE `xray_schedule`
  ADD PRIMARY KEY (`HN`);

--
-- Indexes for table `xray_sc_calendar`
--
ALTER TABLE `xray_sc_calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `xray_sc_events`
--
ALTER TABLE `xray_sc_events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_ibfk_1` (`calendar_id`);

--
-- Indexes for table `xray_status`
--
ALTER TABLE `xray_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_stock`
--
ALTER TABLE `xray_stock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_tambon`
--
ALTER TABLE `xray_tambon`
  ADD PRIMARY KEY (`TAMBON_CODE`);

--
-- Indexes for table `xray_teaching_cases`
--
ALTER TABLE `xray_teaching_cases`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_teaching_cat`
--
ALTER TABLE `xray_teaching_cat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_type`
--
ALTER TABLE `xray_type`
  ADD PRIMARY KEY (`XRAY_TYPE_CODE`);

--
-- Indexes for table `xray_usage`
--
ALTER TABLE `xray_usage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_user`
--
ALTER TABLE `xray_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_user_df_code`
--
ALTER TABLE `xray_user_df_code`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `xray_user_right`
--
ALTER TABLE `xray_user_right`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `xray_user_type`
--
ALTER TABLE `xray_user_type`
  ADD UNIQUE KEY `CODE` (`CODE`);

--
-- Indexes for table `xray_user_worklist_dictate`
--
ALTER TABLE `xray_user_worklist_dictate`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`),
  ADD KEY `ID_2` (`ID`);

--
-- Indexes for table `xray_user_worklist_examroom`
--
ALTER TABLE `xray_user_worklist_examroom`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`),
  ADD KEY `ID_2` (`ID`);

--
-- Indexes for table `xray_user_worklist_order`
--
ALTER TABLE `xray_user_worklist_order`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`),
  ADD KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xray_api_client`
--
ALTER TABLE `xray_api_client`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xray_auto`
--
ALTER TABLE `xray_auto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xray_billing`
--
ALTER TABLE `xray_billing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_body_part`
--
ALTER TABLE `xray_body_part`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `xray_center`
--
ALTER TABLE `xray_center`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xray_configs`
--
ALTER TABLE `xray_configs`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `xray_film_folder`
--
ALTER TABLE `xray_film_folder`
  MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_labresult`
--
ALTER TABLE `xray_labresult`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `xray_log`
--
ALTER TABLE `xray_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1126;

--
-- AUTO_INCREMENT for table `xray_modalities`
--
ALTER TABLE `xray_modalities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `xray_modalities_type`
--
ALTER TABLE `xray_modalities_type`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xray_news`
--
ALTER TABLE `xray_news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xray_order_cart`
--
ALTER TABLE `xray_order_cart`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3736;

--
-- AUTO_INCREMENT for table `xray_patient_info`
--
ALTER TABLE `xray_patient_info`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `xray_patient_rel`
--
ALTER TABLE `xray_patient_rel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `xray_preparation`
--
ALTER TABLE `xray_preparation`
  MODIFY `PREP_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xray_radiologist_assign`
--
ALTER TABLE `xray_radiologist_assign`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xray_radiologist_group`
--
ALTER TABLE `xray_radiologist_group`
  MODIFY `GROUP_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_radiologist_group_modality`
--
ALTER TABLE `xray_radiologist_group_modality`
  MODIFY `GROUP_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xray_referrer`
--
ALTER TABLE `xray_referrer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `xray_report`
--
ALTER TABLE `xray_report`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `xray_report_structure`
--
ALTER TABLE `xray_report_structure`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `xray_report_template`
--
ALTER TABLE `xray_report_template`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `xray_request`
--
ALTER TABLE `xray_request`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `xray_request_detail`
--
ALTER TABLE `xray_request_detail`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `xray_sc_calendar`
--
ALTER TABLE `xray_sc_calendar`
  MODIFY `calendar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `xray_sc_events`
--
ALTER TABLE `xray_sc_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_status`
--
ALTER TABLE `xray_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `xray_stock`
--
ALTER TABLE `xray_stock`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_teaching_cases`
--
ALTER TABLE `xray_teaching_cases`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_teaching_cat`
--
ALTER TABLE `xray_teaching_cat`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `xray_usage`
--
ALTER TABLE `xray_usage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_user`
--
ALTER TABLE `xray_user`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `xray_user_df_code`
--
ALTER TABLE `xray_user_df_code`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xray_user_right`
--
ALTER TABLE `xray_user_right`
  MODIFY `USER_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `xray_user_type`
--
ALTER TABLE `xray_user_type`
  MODIFY `CODE` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xray_user_worklist_dictate`
--
ALTER TABLE `xray_user_worklist_dictate`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `xray_user_worklist_examroom`
--
ALTER TABLE `xray_user_worklist_examroom`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `xray_user_worklist_order`
--
ALTER TABLE `xray_user_worklist_order`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `xray_sc_events`
--
ALTER TABLE `xray_sc_events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`calendar_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
