-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 28. 23:31
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `macskak`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `macska`
--

CREATE TABLE `macska` (
  `id` int(11) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `szuletesi_nap` date NOT NULL,
  `suly` int(3) NOT NULL,
  `nem` varchar(30) NOT NULL,
  `kinezet` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `macska`
--

INSERT INTO `macska` (`id`, `nev`, `szuletesi_nap`, `suly`, `nem`, `kinezet`) VALUES
(5, 'Garfield', '1978-06-19', 30, 'kandúr', 'vörös cirmos'),
(6, 'Katty', '2012-01-01', 10, 'ivartalanított nőstény', 'cirmos fehér'),
(7, 'Donna', '2013-09-10', 10, 'ivartalanított nőstény', 'fehér'),
(8, 'Random Cica 1', '2003-10-30', 12, 'nőstény', 'fekete'),
(9, 'Random Cica 2', '2001-05-12', 13, 'herélt', 'fekete fehér foltos');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `macska`
--
ALTER TABLE `macska`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `macska`
--
ALTER TABLE `macska`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
