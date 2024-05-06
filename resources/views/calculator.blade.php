<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculator</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    
                    <main class="mt-6">
                        <div class="flex justify-center">
                            <div x-data="calculator()" x-init="init()" class="flex flex-col items-start rounded-lg p-3 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] bg-zinc-900 w-[300px]">
                                <div x-show="result">
                                    <span x-text="old_result"></span>
                                    <span x-text="old_operator"></span>
                                    <span x-text="old_value2"></span>
                                    <span x-show="old_result">=</span>
                                    <span x-text="result"></span>
                                </div>

                                <div>
                                    <select name="operation" class="bg-zinc-900 appearance-none" x-model="operation">
                                        <option value=""></option>
                                        <option value="add" selected>+</option>
                                        <option value="multiply">x</option>
                                        <option value="substract">-</option>
                                        <option value="divide">/</option>
                                    </select>
                                    <input class="bg-zinc-900" type="text" name="value2" id="value2" size="10"  x-model="value2" />
                                </div>
                                
                                <div class="grid grid-cols-4 gap-3 mt-5 w-full">
                                    <x-button text="7" class="bg-gray-200 text-black" @click="appendNumber('7')" />
                                    <x-button text="8" class="bg-gray-200 text-black" @click="appendNumber('8')" />
                                    <x-button text="9" class="bg-gray-200 text-black" @click="appendNumber('9')" />
                                    <x-button text="x" class="bg-yellow-500 text-white" @click="appendOperator('multiply')" />
                                    <x-button text="4" class="bg-gray-200 text-black" @click="appendNumber('4')" />
                                    <x-button text="5" class="bg-gray-200 text-black" @click="appendNumber('5')" />
                                    <x-button text="6" class="bg-gray-200 text-black" @click="appendNumber('6')" />
                                    <x-button text="/" class="bg-yellow-500 text-white"  @click="appendOperator('divide')" />
                                    <x-button text="1" class="bg-gray-200 text-black" @click="appendNumber('1')" />
                                    <x-button text="2" class="bg-gray-200 text-black" @click="appendNumber('2')" />
                                    <x-button text="3" class="bg-gray-200 text-black" @click="appendNumber('3')" />
                                    <x-button text="-" class="bg-yellow-500 text-white"  @click="appendOperator('substract')" />
                                    <x-button text="0" class="bg-gray-200 text-black" @click="appendNumber('0')" />
                                    <x-button text="." class="bg-gray-200 text-black" @click="appendNumber('.')" />
                                    <x-button text="=" class="bg-green-500 text-white" @click="calculate" />
                                    <x-button text="+" class="bg-yellow-500 text-white" @click="appendOperator('add')" />
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
    <script>
        function calculator() {
            return {
                value2: '',
                operators: {
                    add: '+',
                    multiply: 'x',
                    substract: '-',
                    divide: '/'
                },
                operation: null,
                result: 0,
                old_result: '',
                old_value2: '',
                old_operator: '',
                init() {
                    // Any initialization logic goes here
                },
                appendNumber(number) {
                    this.value2 += number.toString();
                },
                appendOperator(operation) {
                    this.operation = operation;
                    if(this.result == '') {
                        this.result = this.value2;
                        this.value2 = '';
                    }
                },
                calculate() {                        
                    fetch('{{ route('calculate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            value1: this.result,
                            value2: this.value2,
                            operation: this.operation
                        })
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    }).then((data) => {                        
                        this.old_result = this.result;
                        this.result = data.result;
                        this.old_value2 = this.value2;                        
                        this.old_operator = this.operators[this.operation];
                        this.value2 = '';
                        this.operation = '';
                    })
                    .catch((response) => {
                        console.error('Error:', response.toString());
                    })
                }
            }
        }
    </script>
</html>
