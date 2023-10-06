<template>
   
    <div class="flex h-screen bg-gray-200 font-roboto">
        <Navigation />

        <div class="flex flex-1 flex-col overflow-hidden">
            <Header />

            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-200">
                <div class="container mx-auto px-6 py-3">
                    <h3 class="mb-4 text-3xl font-medium text-gray-700">
                        <slot name="header" />
                    </h3>

                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
//import Header from '@/Components/Header.vue';
import Header from '@/Layouts/Header.vue';
import Navigation from '@/Layouts/Navigation.vue';
import ToastList from '@/Components/ToastList.vue';
</script>

<script>
			window.addEventListener('showToastr', function(event){
				toastr.remove();
				if(event.detail.type === 'info'){ toastr.info(event.detail.message);}
				else if (event.detail.type === 'success'){ toastr.success(event.detail.message); }
				else if (event.detail.type === 'error'){ toastr.error(event.detail.message); }
				else if (event.detail.type === 'warning'){ toastr.warning(event.detail.message);}
				else{ return false; }
			});
		</script>
