
CREATE TABLE IF NOT EXISTS `reservasi` (
  `id_reservasi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT UNSIGNED NOT NULL,
  `id_ruangan` INT UNSIGNED NOT NULL,
  `tanggal` DATE NOT NULL,
  `jam_mulai` TIME NOT NULL,
  `jam_selesai` TIME NOT NULL,
  `keperluan` TEXT NOT NULL,
  `jumlah_orang` INT NOT NULL DEFAULT 1,
  `status` ENUM('menunggu','diterima','ditolak','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reservasi`),
  INDEX `reservasi_id_user_index` (`id_user`),
  INDEX `reservasi_id_ruangan_index` (`id_ruangan`),
  CONSTRAINT `reservasi_fk_user` FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservasi_fk_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan`(`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
