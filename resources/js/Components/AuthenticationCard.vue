<template>
	<div class="cover animated fadeIn">
		<div class="min-h-screen flex md:flex-col justify-center items-center pt-6 sm:pt-0">
			<div
				class="w-11/12 md:w-4/5 2xl:w-1/2 md:mt-6 bg-white md:shadow-card overflow-hidden rounded-lg flex flex-wrap md:px-0 px-5 shadow-lg items-center">
				<div class="w-full md:w-2/5 md:pt-0 pt-5">
					<div class="h-full">
						<img src="@/Assets/images/logo-updated.png" class="h-full w-1/2 md:w-full md:object-cover m-auto" />
					</div>
				</div>
				<div class="w-full md:w-3/5 px-6 md:py-16 pb-5 pt-7 flex items-center h-full">
					<div>
						<h2 class="font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg md:mb-10 mb-5 md:text-left text-center">
							Sistema de Gestión de Procesos de Negocios
						</h2>
						<slot />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<style scoped lang="scss">
.cover {
	background-image: linear-gradient(300deg, #0E121E, #0E121E 0%, transparent 0%, transparent), url('@/Assets/images/tilt.svg');
	background-repeat: no-repeat;
	background-position-y: top;
	background-position-x: right;
	background-size: 100% 100%;
}
</style>