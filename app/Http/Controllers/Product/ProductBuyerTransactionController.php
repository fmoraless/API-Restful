<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
          'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request, $rules);

        //comprobar que el comprador no sea el mismo que el vendedor.
        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('El comprador debe ser diferente al vendedor.', 409);
        }
        if (!$buyer->esVerificado()) {
            return $this->errorResponse('El comprador debe ser un usuario verificado', 409);
        }
        /*if (!$product->seller->esVerificado()) {
            return $this->errorResponse('El vendedor debe ser un usuario verificado', 409);
        }*/
        if (!$product->estaDisponible()) {
            return $this->errorResponse('El para esta transacción no está disponibe', 409);
        }
        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('El producto no tiene la cantidad disponible para esta transcción',
                409);
        }

        ///Se pueden generar transacciones simultaneas, por lo que para controllar se debe hacer una transaccion
        /// a traves de transacciones.
        ///
        return DB::transaction(function () use ($request, $product, $buyer) {
            /** reducir la cantidad disponible de un producto  */
           $product->quantity -= $request->quantity;
           $product->save();

           $transaction = Transaction::create([
               'quantity' => $request->quantity,
               'buyer_id' => $buyer->id,
               'product_id' => $product->id,
           ]);
           return $this->showOne($transaction, 201);
        });

    }

}
