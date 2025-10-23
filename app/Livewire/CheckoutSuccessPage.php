<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;

class CheckoutSuccessPage extends Component
{
    public ?Cart $cart;

    public Order $order;

    public function mount(): void
    {
        // Get the order ID from session or redirect to home if not found
        $orderId = session('completed_order_id');
        
        if (!$orderId) {
            $this->redirect('/');
            return;
        }
        
        // Find the order
        $this->order = Order::find($orderId);
        
        if (!$this->order) {
            $this->redirect('/');
            return;
        }
        
        // Clear the session
        session()->forget('completed_order_id');
    }

    public function render(): View
    {
        return view('livewire.checkout-success-page');
    }
}
