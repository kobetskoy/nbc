<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calculate</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
	<div class="flex items-center h-screen w-full bg-teal-lighter">
		<div class="w-full bg-white rounded shadow-lg p-8 m-4 md:max-w-sm md:mx-auto">
			<h1 class="block w-full text-center mb-6">Расчет стоимости карты</h1>
			<div id="app">
			  <form class="mb-4 md:flex md:flex-wrap md:justify-between" @submit.prevent="processForm">
				<div class="field-group mb-4 md:w-full">
					<label for="productPrice" class="field-label">Цена продукта</label>
					<div class="mt-1 relative rounded-md shadow-sm mb-4"> 
						<input type="text" v-model="productPrice" name="productPrice" class=" focus:ring-indigo-500 focus:border-indigo-600 active:outline-none active:border-indigo-600 focus:outline-none block w-full pl-3 pr-12 pt-3 pb-2 border-gray-400 rounded-md" placeholder="0.00">
						<div class="absolute inset-y-0 right-0 flex items-center">руб.</div>
					</div>
				</div>
				
				
			  </form>
			</div>
		</div>
	</div>
		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	
      <script id="rendered-js">

var options = {};
var productPrice = '';
var warranty = '';

    </script>
</body>
</html>