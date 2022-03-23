-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Maj 2019, 11:11
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pizzacms2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_zamowienia` int(11) NOT NULL,
  `imie` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `miejscowosc` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `nr_domu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_zamowienia`, `imie`, `nazwisko`, `miejscowosc`, `nr_domu`) VALUES
(1, 'przyklad', 'przyklad', 'przyklad', 0),
(2, 'Dawid', 'Potocki', 'Raniżów', 15),
(3, 'Jakub', 'Wolan', 'Stobierna', 32),
(4, 'Rafał', 'Ciomuk', 'Osia Góra', 12),
(5, 'Darek', 'Pazura', 'Posuchy', 54),
(6, 'Robert', 'Ozga', 'Mazury', 75),
(7, 'Paweł', 'Kasza', 'Korczowiska', 75),
(8, 'Paweł', 'Kasza', 'Korczowiska', 75),
(9, 'Damian', 'Kolano', 'Poręby', 26);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wartosc`
--

CREATE TABLE `wartosc` (
  `id_zamowienia` int(11) NOT NULL,
  `hawajska` int(11) NOT NULL,
  `h_wielkosc` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `bogacz` int(11) NOT NULL,
  `b_wielkosc` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `miesna` int(11) NOT NULL,
  `m_wielkosc` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wartosc`
--

INSERT INTO `wartosc` (`id_zamowienia`, `hawajska`, `h_wielkosc`, `bogacz`, `b_wielkosc`, `miesna`, `m_wielkosc`, `ilosc`, `cena`, `data`) VALUES
(1, 0, '0', 0, '0', 0, '0', 0, 0, '2019-05-01 00:00:00'),
(2, 3, 'mala', 2, 'duza', 0, '0', 5, 112, '2019-05-31 10:29:30'),
(3, 1, 'mala', 2, 'duza', 0, '0', 3, 76, '2019-05-31 10:31:37'),
(4, 3, 'mala', 1, 'srednia', 0, '0', 4, 81, '2019-05-31 10:32:20'),
(5, 3, 'mala', 2, 'duza', 1, 'mala', 6, 131, '2019-05-31 10:37:30'),
(6, 2, 'srednia', 0, 'mala', 2, 'srednia', 4, 86, '2019-05-31 10:43:23'),
(7, 1, 'mala', 1, 'mala', 2, 'duza', 4, 92, '2019-05-31 10:55:15'),
(8, 1, 'mala', 1, 'mala', 2, 'duza', 4, 92, '2019-05-31 10:56:08'),
(9, 0, '0', 0, '0', 1, 'mala', 1, 19, '2019-05-31 10:58:01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_pracownicy` int(11) NOT NULL,
  `id_kierowcy` int(11) NOT NULL,
  `metoda_platnosci` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `id_pracownicy`, `id_kierowcy`, `metoda_platnosci`, `data`) VALUES
(1, 1, 1, 'przyklad', '2019-05-01'),
(2, 1, 1, 'gotowka', '2019-05-31'),
(3, 1, 1, 'gotowka', '2019-05-31'),
(4, 1, 1, 'karta', '2019-05-31'),
(5, 1, 1, 'gotowka', '2019-05-31'),
(6, 1, 1, 'gotowka', '2019-05-31'),
(7, 1, 1, 'gotowka', '2019-05-31'),
(8, 1, 1, 'gotowka', '2019-05-31'),
(9, 1, 1, 'gotowka', '2019-05-31');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- Indeksy dla tabeli `wartosc`
--
ALTER TABLE `wartosc`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `wartosc`
--
ALTER TABLE `wartosc`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_zamowienia`) REFERENCES `klienci` (`id_zamowienia`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`id_zamowienia`) REFERENCES `wartosc` (`id_zamowienia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
