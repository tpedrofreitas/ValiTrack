import axios from 'axios';

// Ajuste a baseURL conforme seu ambiente de desenvolvimento.
// Se estiver usando `php artisan serve` em http://127.0.0.1:8000 e
// testando no emulador Android use 'http://10.0.2.2:8000', no iOS 'http://localhost:8000'.
const BASE_URL = 'http://127.0.0.1:8000/api/v1';

const api = axios.create({
  baseURL: BASE_URL,
  headers: { 'Accept': 'application/json' },
});

export default api;
