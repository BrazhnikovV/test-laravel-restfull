<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @ProductPolicy
 * @package App\Policies
 */
class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return Response|bool
     */
    public function viewAny(?User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Product $product
     * @return bool
     */
    public function view(?User $user, Product $product): bool
    {
        return (int)$product->published === 1;
    }

    /**
     * Determine whether the user can view the product's categories.
     *
     * @param User|null $user
     * @param Product $product
     * @return Response|bool
     */
    public function viewCategories(?User $user, Product $product): Response|bool
    {
        return $this->view($user, $product);
    }

    /**
     * Determine whether the user can update the model's categories relationship.
     *
     * @param User $user
     * @param Product $product
     * @return bool|Response
     */
    public function updateCategories(User $user, Product $product): Response|bool
    {
        return $this->update($user, $product);
    }

    /**
     * Determine whether the user can attach tags to the model's categories relationship.
     *
     * @param User $user
     * @param Product $product
     * @return bool|Response
     */
    public function attachCategories(User $user, Product $product): Response|bool
    {
            return $this->update($user, $product);
    }

    /**
     * Determine whether the user can detach tags from the model's categories relationship.
     *
     * @param User $user
     * @param Product $product
     * @return bool|Response
     */
    public function detachCategories(User $user, Product $product): Response|bool
    {
            return $this->update($user, $product);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response|bool
     */
    public function update(User $user, Product $product): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response|bool
     */
    public function delete(User $user, Product $product): Response|bool
    {
        return $this->update($user, $product);
    }
}
