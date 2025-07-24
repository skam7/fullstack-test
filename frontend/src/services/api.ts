import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
});

export default {
  async getProducts() {
    const response = await api.get('/products');
    let responseData = response.data;
    return responseData.data;
  },
  
  async getProduct(id: number) {
    const response = await api.get(`/products/${id}`);
    return response.data;
  },
  
  async createProduct(product: {
    name: string;
    description: string;
    price: number;
    stock: number;
  }) {
    const response = await api.post('/products', product);
    return response.data;
  },
  
  async updateProduct(id: number, product: {
    name?: string;
    description?: string;
    price?: number;
    stock?: number;
  }) {
    const response = await api.put(`/products/${id}`, product);
    return response.data;
  },
  
  async deleteProduct(id: number) {
    await api.delete(`/products/${id}`);
  }
};