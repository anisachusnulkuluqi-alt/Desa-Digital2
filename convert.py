import pandas as pd
import json
import os
import subprocess

# Nama file CSV sumber yang baru
csv_file = 'data_wisata.csv'

# Membaca file CSV
df = pd.read_csv(csv_file, encoding='latin-1')
df = df.fillna('') 

# Mengubah ke format JSON
data_json = df.to_dict(orient='records')

# Menyimpan hasilnya menjadi file wisata.json di root
with open('wisata.json', 'w', encoding='utf-8') as f:
    json.dump(data_json, f, ensure_ascii=False, indent=4)

# Menyimpan juga ke public/json/wisata.json jika foldernya ada
public_json_path = os.path.join('public', 'json', 'wisata.json')
if os.path.exists(os.path.dirname(public_json_path)):
    with open(public_json_path, 'w', encoding='utf-8') as f:
        json.dump(data_json, f, ensure_ascii=False, indent=4)

print("Berhasil konversi CSV ke JSON (wisata.json)!")

# Otomatis impor data ke database Laravel jika php tersedia
try:
    res = subprocess.run(['php', 'artisan', 'wisata:import'], capture_output=True, text=True)
    if res.returncode == 0:
        print("Berhasil sinkronisasi otomatis ke tabel database wisata!")
    else:
        print("Catatan: Jalankan 'php artisan wisata:import' untuk menyinkronkan ke database.")
except Exception:
    pass