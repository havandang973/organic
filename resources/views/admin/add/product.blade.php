@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('add.product')}}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Tên sản phẩm')" />
                        <x-text-input placeholder="Tên sản phẩm" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mt-4 flex gap-4">
                        <div class="flex-1">
                            <x-input-label for="price" :value="__('Giá sản phẩm')" />
                            <x-text-input placeholder="Giá sản phẩm" id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')"  autofocus autocomplete="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="discount" :value="__('Giảm giá (%)')" />
                            <x-text-input placeholder="Giảm giá (%)" id="discount" class="block mt-1 w-full" type="text" name="discount" :value="old('discount')"  autofocus autocomplete="discount" />
                            <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4 flex gap-4">
                        <div class="flex-1">
                            <x-input-label for="code" :value="__('Code')" />
                            <x-text-input placeholder="Code" id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"  autofocus autocomplete="code" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="img" :value="__('Ảnh sản phẩm')" />
                            <input type="file" name="img" class="block focus:outline-none outline-none w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                            <x-input-error :messages="$errors->get('img')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="brand" :value="__('Thương hiệu')" />
                            <x-text-input placeholder="Thương hiệu" id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')"  autofocus autocomplete="brand" />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4 flex gap-4">
                        <div class="flex-1">
                            <x-input-label for="color" :value="__('Màu sắc')" />
                            <x-text-input placeholder="Màu sắc" id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')"  autofocus autocomplete="color" />
                            <x-input-error :messages="$errors->get('color')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="origin" :value="__('Nguồn gốc')" />
                            <x-text-input placeholder="Nguồn gốc" id="origin" class="block mt-1 w-full" type="text" name="origin" :value="old('origin')"  autofocus autocomplete="origin" />
                            <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="max_amount" :value="__('Số lượng tối da')" />
                            <x-text-input placeholder="Số lượng tối da" id="max_amount" class="block mt-1 w-full" type="text" name="max_amount" :value="old('max_amount')"  autofocus autocomplete="max_amount" />
                            <x-input-error :messages="$errors->get('max_amount')" class="mt-2" />
                        </div>
                    </div>
{{--                    <div>--}}
{{--                        <x-input-label for="name" :value="__('Số lượng')" />--}}
{{--                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--                        <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--                    </div>--}}
{{--                    <div class="mt-4">--}}
{{--                        <x-input-label for="describe" :value="__('Mô tả')" />--}}
{{--                        <x-text-input placeholder="Mô tả" id="describe" class="block mt-1 w-full" type="text" name="describe" :value="old('describe')" required autofocus autocomplete="describe" />--}}
{{--                        <x-input-error :messages="$errors->get('describe')" class="mt-2" />--}}
{{--                    </div>--}}
                    <div class="mt-4">
                        <x-input-label for="describe" :value="__('Mô tả')" />
                        <textarea id="describe" name="describe" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mô tả sản phẩm...">{{old('describe')}}</textarea>
                        <x-input-error :messages="$errors->get('describe')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-center flex-col mt-4 space-y-2">
                        <x-primary-button class="ms-4">
                            Thêm mới
                        </x-primary-button>
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">Tên sản phẩm</label>--}}
{{--                                <input class="form-control" type="text" name="name" id="name">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">Giá</label>--}}
{{--                                <input class="form-control" type="text" name="name" id="name">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="intro">Mô tả sản phẩm</label>--}}
{{--                                <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="intro">Chi tiết sản phẩm</label>--}}
{{--                        <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Danh mục</label>--}}
{{--                        <select class="form-control" id="">--}}
{{--                            <option>Chọn danh mục</option>--}}
{{--                            <option>Danh mục 1</option>--}}
{{--                            <option>Danh mục 2</option>--}}
{{--                            <option>Danh mục 3</option>--}}
{{--                            <option>Danh mục 4</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Trạng thái</label>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>--}}
{{--                            <label class="form-check-label" for="exampleRadios1">--}}
{{--                                Chờ duyệt--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">--}}
{{--                            <label class="form-check-label" for="exampleRadios2">--}}
{{--                                Công khai--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </form>
            </div>
        </div>
    </div>
@endsection
