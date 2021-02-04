<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calculate</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
	<div class="flex items-center h-screen w-full bg-teal-lighter">
		<div class="w-full bg-white rounded shadow-lg p-8 m-4 md:max-w-md md:mx-auto">
			<h1 class="block w-full text-center mb-6 text-xl font-black">Расчет стоимости карты</h1>
			<div id="app">
			  <form class="mb-4 md:flex md:flex-wrap md:justify-between" @submit.prevent="processForm">
				<div class="field-group mb-8 md:w-full">
					<label for="productPrice" class="field-label text-xl">Введите цену продукта</label>
					<div class="mt-1 relative rounded-md shadow-sm mb-4"> 
						<input type="text" v-model="productPrice" class=" focus:ring-indigo-500 focus:border-indigo-600 active:outline-none active:border-indigo-600 focus:outline-none block w-full pl-3 pr-12 pt-3 pb-2 border-gray-400 rounded-md" placeholder="0.00">
						<div class="absolute inset-y-0 right-0 flex items-center">руб.</div>
					</div>

					<label class="block mt-6">
					<select v-model="productSelect" class="form-select mt-1 block w-full">
						<option value="" selected >или укажите модель устройства</option>
						<option v-for="item, index in productList" :value="item.price" >{{item.name}}</option>
					</select>
					</label>
				</div>
				<div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
				  <div class="px-2 w-1/2"> 
					<h3 class="text-gray-700 text-xl">Гарантия</h3>
					<div class="mt-2">
					  <div>
						<label class="inline-flex items-center">
						  <input type="radio" v-model="warranty"  class="form-radio h-5 w-5 text-gray-600" checked value="2"><span class="ml-2 text-gray-700">2 года</span>
						</label>
					  </div>
					  <div>
						<label class="inline-flex items-center mt-3">
						  <input type="radio" v-model="warranty" class="form-radio h-5 w-5 text-gray-600" value="3"><span class="ml-2 text-gray-700">3 года</span>
						</label>
					  </div>
					</div>
				  </div>
				  <div class="px-2 w-1/2">
					<h3 class="text-gray-700 text-xl">Опции</h3>
					<div class="mt-2">
					  <div>
						<label class="inline-flex items-center">
						  <input type="checkbox" class="form-checkbox" v-model="options.setup">
						  <span class="ml-2">Настройка</span>
						</label>
					  </div>
					  <div>
						<label class="inline-flex items-center mt-3">
						  <input type="checkbox" class="form-checkbox" v-model="options.temporaryDevice">
						  <span class="ml-2">Подменное устройство</span>
						</label>
					  </div>
					</div>
				  </div>
				</div>
				<div class="flex flex-col w-full">
					<button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-auto mt-6" >Расчитать стоимость</button>
					<div id="calculationResult" class="flex text-lg text-center mx-auto mt-6 p-2"></div>
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
		var productSelect = {};
		var warranty = '';
		vm = new Vue({
		el : "#app",
		data : {
			productPrice: '',
			productSelect: '',
			warranty: 2,
			options: {setup: 'true'},
			productList: []
		},
		methods : {
			processForm : function(){
				var params = new URLSearchParams();
				params.append('productPrice', this.productPrice);
				params.append('productSelect', this.productSelect);
				params.append('warranty', this.warranty);
				params.append('options', JSON.stringify(this.options));
				
				axios.post('/api/getCardCost.php', params)
				.then(function(response) {
					document.getElementById("calculationResult").innerHTML = response.data.message;
				})
				.catch(function(error) {
					console.warn(error);
				});
			}
		},
		mounted() {
			var app = this;
			axios.get('/api/getList.php')
			.then(function (response) {
				app.productList = response.data;
			})
			.catch(function (resp) {
				console.log(resp);
				alert("Не удалось получить данные");
			});
		},

		});
    </script>
</body>
</html>