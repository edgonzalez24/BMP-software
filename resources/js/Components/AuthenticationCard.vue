<template>
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-200">
		<div class="w-full md:w-4/5 2xl:w-1/2 mt-6 bg-white md:shadow-card overflow-hidden sm:rounded-lg flex flex-wrap md:px-0 px-5">
			<div class="w-full md:w-2/5">
				<div class="h-full">
					<img src="@/Assets/images/logo-updated.png" class="h-full w-full object-cover" />
				</div>
			</div>
			<div class="w-full md:w-3/5 px-6 md:py-16 py-10">
				<h2 class="font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg mb-10">
					Sistema de Gestión de Procesos de Negocios
				</h2>
				<slot />
			</div>
		</div>
	</div>
</template>
