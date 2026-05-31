-- ============================================
-- Fecha: 30/05/2026
-- Proyecto: Medicos (Laravel)
-- Hosting: InfinityFree
-- ============================================

-- 1. Ir a phpMyAdmin en InfinityFree > seleccionar tu BD

-- 2. Ejecutar:

CREATE TABLE medicos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    fnac DATE NOT NULL,
    aniotituto YEAR NOT NULL,
    celular VARCHAR(15) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    UNIQUE KEY celular_unique (celular)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Verificar con:
-- SHOW TABLES;
-- DESCRIBE medicos;
