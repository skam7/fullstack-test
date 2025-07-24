<script setup lang="ts">
import { ref } from 'vue';
import ProductForm from './components/ProductForm.vue';
import ProductList from './components/ProductList.vue';

const productListKey = ref(0); // This will force-reload ProductList when changed

const handleProductCreated = () => {
  productListKey.value++; // This will trigger a reload
};
</script>

<template>
  <header>

   
  </header>

  <main>
     <div class="wrapper">
      <ProductForm @product-created="handleProductCreated"/>
    </div>
    <div>
      <ProductList :key="productListKey"/>
    </div>
    
  </main>
</template>

