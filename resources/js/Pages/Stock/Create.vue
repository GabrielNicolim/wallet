<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const form = useForm({
  name: '',
  quantity: '',
  average_price: '',
  ceiling_price: '',
  sector_id : null,
})

defineProps({
  wallet: {
    type: Object,
  },
  sectors: {
    type: Array,
  },
})
</script>

<template>
  <Head title="Ativo" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar - Ativo</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <h2 class="text-lg font-medium text-gray-900">Informações do ativo</h2>

          <form class="mt-6 space-y-6 md:w-1/2" @submit.prevent="form.post(route('stock.store', wallet.id))">
            <div>
              <InputLabel for="name" value="Nome" />

              <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
              />

              <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
              <InputLabel for="sector" value="Setor" />

              <select
                id="sector"
                v-model="form.sector_id"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
              >
                <option v-for="sector in sectors" :key="sector.id" :value="sector.id" v-text="sector.name" />
              </select>

              <InputError class="mt-2" :message="form.errors.sector_id" />
            </div>

            <div>
              <InputLabel for="ceiling_price" value="Preço teto" />

              <TextInput
                id="ceiling_price"
                v-model="form.ceiling_price"
                type="text"
                class="mt-1 block w-full"
              />

              <InputError class="mt-2" :message="form.errors.ceiling_price" />
            </div>

            <div>
              <InputLabel for="wallet" value="Carteira" />

              <TextInput
                id="wallet"
                type="text"
                :value="wallet.name"
                disabled
                class="mt-1 block w-full"
              />
            </div>

            <h2 class="text-lg font-medium text-gray-900">Informações da operação inicial</h2>

            <div>
              <InputLabel for="average_price" value="Preço médio" />

              <TextInput
                id="average_price"
                v-model="form.average_price"
                type="text"
                class="mt-1 block w-full"
              />

              <InputError class="mt-2" :message="form.errors.average_price" />
            </div>

            <div>
              <InputLabel for="quantity" value="Quantidade" />

              <TextInput
                id="quantity"
                v-model="form.quantity"
                type="text"
                class="mt-1 block w-full"
              />

              <InputError class="mt-2" :message="form.errors.quantity" />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="form.processing">Adicionar</PrimaryButton>
              <Link
                :href="route('wallet.manage', wallet.id)"
                as="button"
              >
                <SecondaryButton :disabled="form.processing">Cancelar</SecondaryButton>
              </Link>

              <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo</p>
              </Transition>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
