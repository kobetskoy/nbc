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
			<h1 class="block w-full text-center mb-6 text-xl font-black">Расчет стоимости карты</h1>
			<div id="app">
			  <form class="mb-4 md:flex md:flex-wrap md:justify-between" @submit.prevent="processForm">
				<div class="field-group mb-4 md:w-full">
					<label for="productPrice" class="field-label">Цена продукта</label>
					<div class="mt-1 relative rounded-md shadow-sm mb-4"> 
						<input type="text" v-model="productPrice" name="productPrice" class=" focus:ring-indigo-500 focus:border-indigo-600 active:outline-none active:border-indigo-600 focus:outline-none block w-full pl-3 pr-12 pt-3 pb-2 border-gray-400 rounded-md" placeholder="0.00">
						<div class="absolute inset-y-0 right-0 flex items-center">руб.</div>
					</div>
				</div>
				<div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
				  <div class="px-2 w-1/2"> 
					<h3 class="text-gray-700">Гарантия</h3>
					<div class="mt-2">
					  <div>
						<label class="inline-flex items-center">
						  <input type="radio" v-model="warranty" name="warranty" class="form-radio h-5 w-5 text-gray-600" checked value="2"><span class="ml-2 text-gray-700">2 года</span>
						</label>
					  </div>
					  <div>
						<label class="inline-flex items-center mt-3">
						  <input type="radio" v-model="warranty" name="warranty" class="form-radio h-5 w-5 text-gray-600" value="3"><span class="ml-2 text-gray-700">3 года</span>
						</label>
					  </div>
					</div>
				  </div>
				  <div class="px-2 w-1/2">
					<h3 class="text-gray-700 text-xl">Опции</h3>
					<div class="mt-2">
					  <div>
						<label class="inline-flex items-center">
						  <input type="checkbox" class="form-checkbox" v-model="options.setup" name="options[setup]">
						  <span class="ml-2">Настройка</span>
						</label>
					  </div>
					  <div>
						<label class="inline-flex items-center mt-3">
						  <input type="checkbox" class="form-checkbox" v-model="options.temporaryDevice" name="options[temporaryDevice]">
						  <span class="ml-2">Подменное устройство</span>
						</label>
					  </div>
					</div>
				  </div>
				</div>
				<button type="submit" class="" >Расчитать стоимость</button>
        
				<div id="calculationResult"></div>
				<!--
				  <option v-for="(element, index) in ymlData" :key="index">
					<component :is="element.type" :element="element" />
				  </option>
				-->
			  </form>
			</div>
		</div>
	</div>
		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	
      <script id="rendered-js">
/*
new Vue({
  el: '#app',
  data() {
    return {
      selected: "",
      ymlData: "" };
  },
  );
*/
var options = {};
var productPrice = '';
var warranty = '';
vm = new Vue({
  el : "#app",
  data : {
	productPrice: '',
	warranty: 2,
	options: {setup: 'true'},
  },
  methods : {
    processForm : function(){
		console.log(this.data);

		var params = new URLSearchParams();
		params.append('productPrice', this.productPrice);
		params.append('warranty', this.warranty);
		params.append('options', JSON.stringify(this.options));
		
		axios.post('/api.php', params)
		.then(function(response) {
			document.getElementById("calculationResult").innerHTML = response.data.message;
		})
		.catch(function(error) {
			console.log(error);
		});
     // this.$refs.form.submit()
    }
  }
});
    </script>
</body>
</html>