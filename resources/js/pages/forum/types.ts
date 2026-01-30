export type User = {
    id: string;
    name: string;
    email: string;
    role: string;
};

export type Post = {
    id: number;
    content: string;
    created_at: string;
    updated_at: string;
    reaction: 'like' | 'dislike' | null;
    likesCount: number;
    dislikesCount: number;
    user: User;
}

export type Topic = {
    id: number;
    title: string;
    description: string;
    isOwnPost: boolean;
    owner: User;
    posts: Array<Post>;
    createdAt: string;
};
