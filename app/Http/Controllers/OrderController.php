<?php
namespace App\Http\Controllers;

use App\Models\EventRequest;
use App\Models\Order;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
        ->whereHas('transactions')
        ->with(['transactions' => function($query) {
            $query->orderByDesc('created_at');
        }])
        ->orderByDesc('created_at')
        ->get()
        ->map(function($order) {
            $order->latest_transaction_status = $order->transactions->first()->status;
            return $order;
        });
        return view('history', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status_attend' => 'waiting',
            'unique_order_id' => Str::ulid()
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $order->unique_order_id,
                'gross_amount' =>  $request->total_price
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // order detail
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
        ->where('id', $id)
        ->with(['event', 'transactions'])
        ->first();
        
        if (!$order) {
            abort(404);
        }

        // Example data for QR code
        $data = $order->unique_order_id; 

        // Generate the QR code
        $qrCode = QrCode::size(200)->generate($data);
        $requestApproval = EventRequest::where('order_id', $order->id)->first();

        return view('order-detail', compact('order', 'requestApproval', 'qrCode'));
    }
}
