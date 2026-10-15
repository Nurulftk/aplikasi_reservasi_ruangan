-- =============================================
-- Database: reservasi_ruangan
-- ERD Aplikasi Reservasi Ruangan Kampus
-- =============================================

CREATE DATABASE IF NOT EXISTS reservasi_ruangan
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE reservasi_ruangan;

-- =============================================
-- Tabel: users
-- =============================================
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    nim VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'mahasiswa') NOT NULL DEFAULT 'mahasiswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =============================================
-- Tabel: ruangan
-- =============================================
CREATE TABLE ruangan (
    id_ruangan INT AUTO_INCREMENT PRIMARY KEY,
    nama_ruangan VARCHAR(255) NOT NULL,
    gedung VARCHAR(255) NOT NULL,
    kapasitas INT NOT NULL,
    fasilitas TEXT NULL,
    status ENUM('tersedia', 'tidak tersedia') NOT NULL DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =============================================
-- Tabel: reservasi
-- =============================================
CREATE TABLE reservasi (
    id_reservasi INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_ruangan INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    keperluan TEXT NOT NULL,
    status ENUM('menunggu', 'diterima', 'ditolak', 'dibatalkan') NOT NULL DEFAULT 'menunggu',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_ruangan) REFERENCES ruangan(id_ruangan) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- Tabel: jadwal
-- =============================================
CREATE TABLE jadwal (
    id_jadwal INT AUTO_INCREMENT PRIMARY KEY,
    id_ruangan INT NOT NULL,
    id_reservasi INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    keterangan TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ruangan) REFERENCES ruangan(id_ruangan) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_reservasi) REFERENCES reservasi(id_reservasi) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- Tabel: laporan
-- =============================================
CREATE TABLE laporan (
    id_laporan INT AUTO_INCREMENT PRIMARY KEY,
    id_reservasi INT NOT NULL,
    tanggal_cetak DATE NOT NULL,
    keterangan TEXT NULL,
    FOREIGN KEY (id_reservasi) REFERENCES reservasi(id_reservasi) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
