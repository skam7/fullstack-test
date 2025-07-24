<template>
  <div>
    <div v-if="loading">Cargando...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else>
      <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>
              <input v-if="editingProductId === product.id" v-model="editingProduct.name" class="form-control">
              <span v-else>{{ product.name }}</span>
            </td>
            <td>
              <input v-if="editingProductId === product.id" v-model="editingProduct.description" class="form-control">
              <span v-else>{{ product.description }}</span>
            </td>
            <td>
              <input v-if="editingProductId === product.id" v-model.number="editingProduct.price" type="number" class="form-control">
              <span v-else>${{ product.price }}</span>
            </td>
            <td>
              <input v-if="editingProductId === product.id" v-model.number="editingProduct.stock" type="number" class="form-control">
              <span v-else>{{ product.stock }}</span>
            </td>
            <td>
              <button v-if="editingProductId !== product.id" @click="startEditing(product)" class="btn btn-warning">Editar</button>
              <button v-else @click="updateProduct" class="btn btn-success">Actualizar</button>
              <button v-if="editingProductId !== product.id" @click="handleDelete(product.id)" class="btn btn-danger">Eliminar</button>
              <button v-else @click="cancelEditing" class="btn btn-secondary">Cancelar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">

import { ref, onMounted } from 'vue';
import api from '@/services/api';

interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
  stock: number;
}

const products = ref<Product[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);
const editingProductId = ref<number | null>(null);
const editingProduct = ref<Product>({
  id: 0,
  name: '',
  description: '',
  price: 0,
  stock: 0
});

onMounted(async () => {
  try {
    products.value = await api.getProducts();
  } catch (err) {
    error.value = 'Error al cargar los productos';
    console.error(err);
  } finally {
    loading.value = false;
  }
});

const startEditing = (product: Product) => {
  editingProductId.value = product.id;
  editingProduct.value = { ...product };
};

const cancelEditing = () => {
  editingProductId.value = null;
};

const updateProduct = async () => {
  try {
    if (editingProductId.value) {
      const updatedProduct = await api.updateProduct(editingProductId.value, editingProduct.value);
      const index = products.value.findIndex(p => p.id === editingProductId.value);
      if (index !== -1) {
        products.value[index] = updatedProduct;
      }
      editingProductId.value = null;
    }
  } catch (err) {
   
    error.value = 'Error al actualizar el producto';
  }
};

const handleDelete = async (id: number) => {
  try {
    await api.deleteProduct(id);
    products.value = products.value.filter(p => p.id !== id);
  } catch (err) {
    
    error.value = 'Error al eliminar el producto';
  }
};
</script>

<style scoped>
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.btn {
  margin-right: 5px;
}

.form-control {
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}

.error {
  color: red;
  font-weight: bold;

}
</style>