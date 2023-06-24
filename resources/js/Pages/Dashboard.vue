<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  wallets: {
    type: Array,
  },
})
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
          <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="wallet in wallets" :key="wallet.id" class="w-72 md:w-56 xl:w-64 bg-white shadow-md rounded-lg mx-auto">
              <div class="font-medium h-24 p-2">{{ wallet.name }}</div>
              <Link 
                :href="route('wallet.edit', wallet.id)"
                method="get"
                as="button"
                class="w-full text-center p-1 bg-sky-400 rounded-b-lg text-white"
              >
                Gerenciar
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
