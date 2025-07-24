
<script setup lang="ts">
import { ref } from 'vue';
import ProductList from '@/components/ProductList.vue';
import ProductForm from '@/components/ProductForm.vue';

const refreshKey = ref(0);

const handleProductCreated = () => {
  refreshKey.value++;
};
</script>

<template>
  <div class="products-view">
    <h1>Gestión de Productos</h1>
    
    <div class="product-form-container">
      <h2>Agregar Nuevo Producto</h2>
      <ProductForm @product-created="handleProductCreated" />
    </div>
    
    <div class="product-list-container">
      <h2>Lista de Productos</h2>
      <ProductList :key="refreshKey" />
    </div>
  </div>
</template>