-- Update kategori potensi untuk konsistensi dengan navbar
-- Ubah semua kategori ke lowercase dan sesuaikan dengan dropdown menu

-- Update kategori yang mungkin masih huruf kapital
UPDATE potensis SET category = 'pertanian' WHERE LOWER(category) = 'pertanian';
UPDATE potensis SET category = 'industri' WHERE LOWER(category) IN ('ekonomi', 'industri');
UPDATE potensis SET category = 'wisata' WHERE LOWER(category) IN ('wisata', 'pariwisata');
UPDATE potensis SET category = 'peternakan' WHERE LOWER(category) = 'peternakan';

-- Verifikasi hasil
SELECT DISTINCT category FROM potensis ORDER BY category;
