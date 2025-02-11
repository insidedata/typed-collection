# A collection of support helpers for Laravel

## Typed Collection

Create collections where the items in the collection have to match a given interface or class

> use App\Models\User;
>
>
> $usersList= typed_collection(User::class);
>
> $userList[] = new(User);


> use InsideData\Support\TypedCollection;
>
> use App\Models\User;
>
>
> $usersList= TypedCollection::accepts(User::class);
>
> $userList[] = new(User);
