<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\BinaryOp\Equal;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Messages;
use App\Models\orders;
use App\Models\Products;

class ProductsController extends Controller
{
    public $message  = "";
    /**
     * Adding  to cart
     */
    public function addCart(Request $request){
        $data =  $request->validate([
            'product'=>'required|string',
            'quantity'=>'required|string',
            'company'=>'required|string',
            'shop'=>'required|string',
            'info'=>'required|string',

        ]);
        $data['user_id'] = auth()->user()->id;

        //products table - handle cart items
        Products::create($data);

        $product = Products::where(['user_id'=>auth()->user()->id])->get();
        $items  = Products::where(['user_id'=> auth()->user()->id])->get();
        
        return response([
            'product' => $product,
            'items'=>$items
        ],200);

    }
    /**
     * edit product
     */
    public function editProduct(Request $request){
        $product = Cart::where(['id'=>$request->id])->get();
        return response([
            'product' => $product
        ]);
    }
    /**
     * edit cart
     */
    public function editCart(Request $request){
        $dataId = $request->validate([
            'productId'=>'required'
        ]);
        $data =  $request->validate([
            'product.product'=>'required|string',
            'product.quantity'=>'required|string',
            'product.company'=>'required|string',
            'product.shop'=>'required|string',
        ]);

        $product = Products::where(['id'=>$request->productId])->get();

        $product = [
            'product' =>  $request->product['product'],
            'quantity' =>  $request->product['quantity'],
            // 'price' =>  $request->product['price'],
            'company' =>  $request->product['company'],
            'shop' =>  $request->product['shop'],
            'info' =>  $request->product['info']
        ];
        // $product['total'] = $product['quantity'] *  $product['price'];
        Products::where(['id'=>$request->productId])->update($product);

        return response([
            'items' => Products::where(['user_id'=>auth()->user()->id])->get()
        ],200);
    }
    /**
     * remove item from cart
     */
    public function removeFromCart(Request $request){
        // throw new \Exception($request->id);
        $product = Products::where(['id'=>$request->id])->get();
        Products::destroy($product);
        return response([
            'items' => Products::where(['user_id'=>auth()->user()->id])->get()
        ],200);
    }
    /**
     * cart items
     */
    public function cartItems(){
        $items  = Products::where(['user_id'=> auth()->user()->id])->get();
        return response(['items'=>$items],200);
    }
    /**
     * making an order
     */
    public function order(Request $request){
        $order = $request->validate([
            'rider' => 'required',
            'location' => 'required',
            'phone' => 'required',
        ]);

        $order['info'] = $request['info'];
        $order['user_id'] = auth()->user()->id;
        $order['products'] = Products::select('product','quantity','company','shop','info')->where(['user_id'=>auth()->user()->id])->get();
        Products::where(['user_id'=>auth()->user()->id])->delete();
        orders::create($order);
        $items  = Products::where(['user_id'=> auth()->user()->id])->get();
        return response(['items'=>$items],200);
    }
    /**
     * requesting for a rider
     */
    public function riderRequest(){
        //send a message to the rider  and wait for the response
        $rider = [
            'name'=>'Martin Kimani',
            'username'=>'Marto',
            'loaction'=>'kinoru',
            'price'=>'100',
            'message' => $this->message
        ];
        $rider['response'] = 'available';

        return response($rider);
    }
    /**
     * process continuation confirmation
     */
    public function continueProcess(Request $request){
        if($request->data == 'confirmed'){
            $cartItems = Cart::where(['user_id'=>$request->user()->id])->latest()->get();
            $productNames = array();
            $productQuantity = array();
            $productPrice = array();
            $productCompany = array();
            $productShop = array();

            $productData =  array();
            $total = 0;


            for( $i = 0; $i < count($cartItems); $i++){
//                 $productNames.add($cartItems[$i]['product']);
                    array_push($productNames,$cartItems[$i]['product']);
                    array_push($productQuantity,$cartItems[$i]['quantity']);
                    array_push($productPrice,$cartItems[$i]['price']);
                    array_push($productCompany,$cartItems[$i]['company']);
                    array_push($productShop,$cartItems[$i]['shop']);

//                 'productPrice' => $productPrice,
                    array_push($productData,"ITEM NO ".$i+1 .".* +Product: ".$cartItems[$i]['product'].
                                                        "*  +Quantity: ".$cartItems[$i]['quantity'].
                                                        "*  +Company: ".$cartItems[$i]['company'].
                                                        "*  +Shop: ".$cartItems[$i]['shop'].
                                                        "*  +Price: ".$cartItems[$i]['price']."*++---------------*");
                    $total += ($cartItems[$i]['price']  * $cartItems[$i]['quantity']);


            }

            $messageData["rider"] = "marto";
            $messageData["service"] = "shopping";
            $messageData["user_id"]= Auth::user()->id;
            $messageData["message"] =  "Hello am ".explode(' ',auth()->user()["name"])[0]."\n Service: SHOPPING \n ***SHOPPING LIST*** \n".str_replace("+","\t",str_replace("*", "\n", str_replace('"',' ',str_replace(['[', ']'], '', json_encode($productData)))))."Total =  ".$total;
            Messages::create($messageData);

            $text = "MY SHOPPING LIST IS \n".$productNames[0];
            $data['confirmed'] = $request->data;
            $username   = "pickMe";
            $apiKey     = "atsk_7d5fe9c5e872034c75ef71ce0eecda6b9e6a058edb877461ae541f412b41996c231a7a53";
            $AT = new AfricasTalking($username, $apiKey);
            $sms        = $AT->sms();
            $recipients = "0756634930";
            $this->message = "Hello am ".explode(' ',auth()->user()["name"])[0]."\n Service: SHOPPING \n ***SHOPPING LIST*** \n".str_replace("+","\t",str_replace("*", "\n", str_replace('"',' ',str_replace(['[', ']'], '', json_encode($productData)))))."Total =  ".$total;
            // $this->message($message);
            // $recipients = "+254746906215";
//             $message = "Hello am ".explode(' ',auth()->user()["name"])[0]."\n am requesting ride services \n Location: ".$ride["location"]." \n Destination: ".$ride["destination"]." \nPick me at  ".$ride["time"];
            // try {
            //     // $result = $sms->send([
            //     //      'to'      => $recipients,
            //     //      'message' => $message,
            //     //   ]);
            // } catch (\Exception $e) {
            //         return response()->json(['error'=>$e->getMessage()],500);
            //     }
            }
            // $res = Cart::where(['user_id'=>$request->user()->id])->update($data);

            return response([
                'res' => Cart::where(['user_id'=>$request->user()->id])->update($data),
                'choice' => $request->data,
                'cartItems' => count($cartItems),
                'productNames' => $productNames,
                'productQuantity' => $productQuantity,
                'productCompany' => $productCompany,
                'productShop' => $productShop,
                'productPrice' => $productPrice,
                'productData' => $this->message,
                'message'  => $text,
                'total' => $total,
                'text' =>   Cart::where('user_id',Auth::user()->id)->get()[0]["destination"],


            ]);

    }
    /**
     * setting the destination (location)
     */
    function setDestination(Request $request){
        $data['destination'] = $request->data['destination'];
        $messageData["destination"] =  $data['destination'] ;
        Messages::where('user_id',Auth::user()->id)->update($messageData);
        return response([
            'res' => Cart::where(['user_id'=>$request->user()->id])->update($data),
            'destination' => $request->data['destination'],
            
        ]);
    }
    /**
     * setting mpesa number
     */
    public function setNumber(Request $request){
        // throw new \Exception($request);
       
        $data['phoneNumber'] = $request->data['numberToCall'];
        $messageData["number"] =  $data['phoneNumber'] ;
        Messages::where('user_id',Auth::user()->id)->update($messageData);

        $result = $this->message();
        return response([
            'res' => Cart::where(['user_id'=>$request->user()->id])->update($data),
            'number' => $request->data['numberToCall'],
            'message' => $result,
        
        ]);
    }
    /**
     * setting conformation code
     */
    public function confirmationCode(Request $request){
        $data['mpesaCode'] = $request->data['confirmationCode'];

        //CONFIRM THAT THE CODE MATCHES THE USER

        
        return response([
            'res' => Cart::where(['user_id'=>$request->user()->id])->update($data),
            'mpesaCode' => $request->data['confirmationCode']
        ]);
    }

    /**
     * messsage service
     */
    public  function message(){
        $username   = "pickMe";
        $apiKey     = "atsk_7d5fe9c5e872034c75ef71ce0eecda6b9e6a058edb877461ae541f412b41996c231a7a53";
        $AT = new AfricasTalking($username, $apiKey);
        $sms        = $AT->sms();
        $recipients = "0756634930";
        $location =  Messages::where('user_id',Auth::user()->id)->latest()->get()[0]["destination"];
        $number =   Messages::where('user_id',Auth::user()->id)->latest()->get()[0]["number"];
        $message = Messages::where('user_id',Auth::user()->id)->latest()->get()[0]["message"]."\n Delivery Location: ".$location."\n Call me incase of anything: ".$number;

  // $recipients = "+254746906215";
        try {
            $result = $sms->send([
                 'to'      => $recipients,
                 'message' => $message,
              ]);
        } catch (\Exception $e) {
                return response()->json(['error'=>$e->getMessage()],500);
            }
        return $result;

    }




   
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
