/** 
 * The 'name' of a class, rather than an instance. 
 * E.g. `MyClass` instead of `new MyClass()`. 
 */
export type ClassType<T> = { new (...args: any[]): T };

type GenericOf<T> = T extends Injectable<infer X> ? X : never;

type ObjectsOnly<T> = {
    [K in keyof T]: Extract<T[K], object>;
};

type ExcludeFromTuple<T extends readonly any[], E> =
    T extends [infer F, ...infer R] ? [F] extends [E] ? ExcludeFromTuple<R, E> :
    [F, ...ExcludeFromTuple<R, E>] : []

type ExcludeNever<T extends readonly any[]> = ExcludeFromTuple<T, never>;

type IsInjectable<T> = T extends Injectable ? T : false;

type MapToClassType<T> = {
    [P in keyof T]: 
        IsInjectable<T[P]> extends Injectable
            ? ClassType<T[P]> 
            : T[P]
};
