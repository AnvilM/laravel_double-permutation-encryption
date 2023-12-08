<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function handler(Request $request)
    {
        //Валидация исходных данных
        $request->validate([
            'src' => 'required|min:20|max:20',
            'func' => 'required|string'
        ]);

        $func = $request->post('func');

        //Вызов выбранного метода
        $this->$func($request->post('src'));
    }

    public function encrypt($src)
    {

        //инициализация переменных

        $cols = [0, 1, 2, 3];
        $rows = [0, 1, 2, 3, 4];

        //Перемешивание колон и строк
        shuffle($cols);
        shuffle($rows);

        //Сохранение значений в сессию
        Session::put('cols', $cols);
        Session::put('rows', $rows);


        //Заполнение массива
        $k = 0;
        for ($i = 0; $i < 5; $i++)
        {
            for ($j = 0; $j < 4; $j++)
            {
                $table[$i][$j] = $src[$k];
                $k++;
            }
        }

        //Вспомогательный массив
        $table2 = $table;

        //Перестановка строк
        for ($i = 0; $i < 5; $i++)
        {
            $table[$i] = $table2[array_search($i, $rows)];
        }

        //Вспомогательный массив
        $table2 = $table;

        //Перестановка столбцов
        for ($i = 0; $i < 5; $i++)
        {
            for ($j = 0; $j < 4; $j++)
            {
                $table[$i][$j] = $table2[$i][array_search($j, $cols)];
            }
        }

        //вывод массива
        for ($i = 0; $i < 4; $i++)
        {
            for ($j = 0; $j < 5; $j++)
            {
                echo $table[$j][$i];
            }
        }
    }

    public function decrypt($src)
    {

        //инициализация переменных

        $cols = Session::get('cols');
        $rows = Session::get('rows');

        //Заполнение массва
        $k = 0;
        for ($i = 0; $i < 4; $i++)
        {
            for ($j = 0; $j < 5; $j++)
            {
                $table[$j][$i] = $src[$k];
                $k++;
            }
        }

        //Вспомогательный массив
        $table2 = $table;

        //Перестановка столбцов
        for ($i = 0; $i < 5; $i++)
        {
            for ($j = 0; $j < 4; $j++)
            {
                $table[$i][array_search($j, $cols)] = $table2[$i][$j];
            }
        }

        //Вспомогательный массив
        $table2 = $table;

        //Перестановка строк
        for ($i = 0; $i < 5; $i++)
        {
            $table[array_search($i, $rows)] = $table2[$i];
        }

        //Вывод массива
        for ($i = 0; $i < 5; $i++)
        {
            for ($j = 0; $j < 4; $j++)
            {
                echo $table[$i][$j];
            }
        }
    }
}
