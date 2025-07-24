<script setup lang="ts">
import { ref } from 'vue';
import api from '@/services/api';
import ProductList from './ProductList.vue';

const ProductListKey = ref(0); // forza la actualización de la lista

const emit = defineEmits(['product-created']);

const newProduct = ref({
  name: '',
  description: '',
  price: 0,
  stock: 0
});

const errors = ref<Record<string, string>>({});
const submitting = ref(false);
const success = ref(false);

const validate = () => {
  errors.value = {};
  
  if (!newProduct.value.name.trim()) {
    errors.value.name = 'El nombre es requerido';
  }
  
  if (newProduct.value.price <= 0) {
    errors.value.price = 'El precio debe ser mayor a 0';
  }
  
  if (newProduct.value.stock < 0) {
    errors.value.stock = 'El stock no puede ser negativo';
  }
  
  return Object.keys(errors.value).length === 0;
};

const handleSubmit = async () => {
  if (!validate()) return;
  
  submitting.value = true;
  
  try {
    await api.createProduct(newProduct.value);
    emit('product-created');
    success.value = true;
    newProduct.value = { name: '', description: '', price: 0, stock: 0 };
    setTimeout(() => success.value = false, 3000);
  } catch (err) {
    console.error('Error al crear el producto', err);
  } finally {
    submitting.value = false;
  }
};
</script>

<template>
  <form @submit.prevent="handleSubmit" class="form-label">
    <div class="form-group">
      <label for="name">Nombre:</label>
      <input v-model="newProduct.name" id="name" type="text" class="form-control" />
      <span v-if="errors.name" class="error">{{ errors.name }}</span>
    </div>
    
    <div class="form-group">
      <label for="description">Descripción:</label>
      <textarea v-model="newProduct.description" id="description" class="form-control"></textarea>
    </div>
    
    <div class="form-group">
      <label for="price">Precio:</label>
      <input v-model.number="newProduct.price" id="price" type="number" step="0.01" class="form-control" />
      <span v-if="errors.price" class="error">{{ errors.price }}</span>
    </div>
    
    <div class="form-group">
      <label for="stock">Stock:</label>
      <input v-model.number="newProduct.stock" id="stock" type="number" class="form-control" />
      <span v-if="errors.stock" class="error">{{ errors.stock }}</span>
    </div>
    
    <button type="submit" :disabled="submitting" class="btn btn-primary">
      {{ submitting ? 'Enviando...' : 'Crear Producto' }}
    </button>
    
    <div v-if="success" class="success">
      Producto creado exitosamente!
    </div>
  </form>
</template>