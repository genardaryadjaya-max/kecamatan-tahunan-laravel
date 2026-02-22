-- Quick update for potensi categories
-- Jalankan via phpMyAdmin atau mysql command line

-- Update kategori
UPDATE potensis SET category = 'pertanian' WHERE category = 'Pertanian';
UPDATE potensis SET category = 'industri' WHERE category = 'Ekonomi' OR category = 'ekonomi' OR category = 'Industri';
UPDATE potensis SET category = 'wisata' WHERE category = 'Wisata' OR category = 'Pariwisata' OR category = 'pariwisata';
UPDATE potensis SET category = 'peternakan' WHERE category = 'Peternakan';

-- Check hasil
SELECT id, name, category FROM potensis ORDER BY category;
